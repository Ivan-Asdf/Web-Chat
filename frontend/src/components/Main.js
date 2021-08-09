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
        switch (response.status) {
          case 200:
            // console.log("PHP", response.data);
            setChatEntries(response.data);
            break;
          case 401:
            window.location.href = "/login";
            break;
          default:
            console.log("index.php HTTP ERROR: ", response.status);
            break;
        }
      })
      .catch((e) => console.log("index.php ERROR:", e));

    // Subscribe to pusher
    // Pusher.logToConsole = true;
    var pusher = new Pusher(process.env.REACT_APP_PUSHER_KEY, {
      cluster: "eu",
    });

    var channel = pusher.subscribe("my-channel");
    channel.bind("my-event", (data) => {
      setChatEntries((chatEntries) => [...chatEntries, data]);
    });
    channel.bind("pusher:subscription_succeeded", () => {
      console.log("subscription-succeeded");
    });
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
      .then((response) => response.text())
      .then((text) => console.log("PHP add_chatentry.php", text))
      .catch((error) => console.log("ERROR: ", error));
  }

  function logoutClicked() {
    axios
      .get(API_HOST + "/logout.php", {
        headers: { Authorization: localStorage.getItem("jwt") },
      })
      .then((response) => {
        switch (response.status) {
          case 200:
            window.location.href = "/login";
            break;
          default:
            console.log("HTTP ERROR: ", response.status);
            break;
        }
      })
      .catch((e) => console.log("logout.php ERROR", e));
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
