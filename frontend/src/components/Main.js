import { useState, useEffect } from "react";
import Pusher from "pusher-js";
import axios from "axios";

import API_HOST from "../config";

import ChatBox from "./ChatBox";

import "./Main.css";

export default function Main() {
  const [chatEntries, setChatEntries] = useState();
  useEffect(() => {
    const jwt = localStorage.getItem("jwt");
    if (!jwt) {
      window.location.href = "/login";
    }
    axios
      .get(API_HOST + "/get_all_chatentries.php", {
        headers: { Authorization: localStorage.getItem("jwt") },
      })
      .then((response) => {
        setChatEntries(response.data);
        pusherSubscribe();
      })
      .catch((e) => {
        if (e.response) {
          console.log("index.php HTTP ERROR:", e.response.status);
          window.location.href = "/login";
        } else {
          console.log("index.php NETWROK ERROR:", e);
        }
      });

    function pusherSubscribe() {
      // Subscribe to pusher
      // Pusher.logToConsole = true;
      var pusher = new Pusher(process.env.REACT_APP_PUSHER_KEY, {
        cluster: "eu",
        authEndpoint: API_HOST + "/pusher_auth.php",
        auth: {
          headers: {
            Authorization: localStorage.getItem("jwt"),
          },
        },
      });

      var channel = pusher.subscribe("private-my-channel");
      channel.bind("my-event", (data) => {
        setChatEntries((chatEntries) => [...chatEntries, data]);
      });
      channel.bind("pusher:subscription_succeeded", () => {
        console.log("subscription-succeeded");
      });
    }
  }, []);

  function sendClicked(e) {
    e.preventDefault();
    const text = e.target.elements.text.value;
    const formData = new FormData();
    formData.append("content", text);

    axios
      .post(API_HOST + "/add_chatentry.php", formData, {
        headers: { Authorization: localStorage.getItem("jwt") },
      })
      .catch((e) => {
        if (e.response) {
          console.log("add_chatentry.php HTTP ERROR:", e.response.status);
        } else {
          console.log("add_chatentry.php NETWROK ERROR:", e);
        }
      });
  }

  function logoutClicked() {
    axios
      .get(API_HOST + "/logout.php", {
        headers: { Authorization: localStorage.getItem("jwt") },
      })
      .then((response) => {
        window.location.href = "/login";
      })
      .catch((e) => {
        if (e.response) {
          console.log("logout.php HTTP ERROR:", e.response.status);
          window.location.href = "/login";
        } else {
          console.log("logout.php NETWROK ERROR:", e);
        }
      });
  }

  return (
    <div className="App">
      <h2>Chat app</h2>
      <ChatBox chatEntries={chatEntries} />
      <form onSubmit={sendClicked}>
        <input className="chatinput" type="text" name="text" required />
        <input type="submit" value="send" />
      </form>
      <button onClick={logoutClicked}>Logout</button>
    </div>
  );
}
