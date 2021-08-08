import { useState, useEffect, useCallback } from "react";
import Pusher from "pusher-js";

import "./Main.css";

import ChatBox from "./ChatBox";

export default function Main() {
  const [chatEntries, setChatEntries] = useState();
  useEffect(() => {
    // Check if logged in
    fetch("http://127.0.0.1:5000/login.php", {
      method: "POST",
      credentials: "include",
    })
      .then((response) => {
        if (response.status === 200) {
          return response.text();
        } else if (response.status === 401) {
          window.location.href = "/login";
        } else {
          console.log("HTTP ERROR: ", response.status);
        }
      })
      .then((text) => {
        console.log("PHP_LOGIN", text);
      })
      .catch((e) => {
        console.log(e);
      });

    fetch("http://127.0.0.1:5000/index.php", { credentials: "include" })
      .then((response) => response.json())
      .then((json) => {
        console.log("PHP", json);
        setChatEntries(json);
      })
      .catch((e) => {
        console.log(e);
      });

    // Subscribe to pusher
    // Pusher.logToConsole = true;

    var pusher = new Pusher("44a73a86f03133cb77c9", {
      cluster: "eu",
    });
    
    var channel = pusher.subscribe("my-channel");
    channel.bind("my-event", (data) => {
        setChatEntries(chatEntries => [...chatEntries, data])
    });
  }, []);


  function onLogout() {
    fetch("http://127.0.0.1:5000/logout.php", {
      credentials: "include",
    })
      .then((response) => {
        if (response.status === 200) {
          window.location.href = "/login";
        } else {
          // SOMETING WONG SHOULD HAPPEN
          console.log("HTTP ERROR: ", response.status);
        }
        return response.text();
      })
      .then((text) => {
        console.log("PHP_LOGOUT", text);
      })
      .catch((e) => {
        console.log("PHP_LOGOUT_ERROR", e);
      });
  }

  function sendClicked(e) {
    e.preventDefault();
    const text = e.target.elements.text.value;
    console.log(text);

    const formData = new FormData();
    formData.append("content", text);

    fetch("http://127.0.0.1:5000/add_chatentry.php", {
      method: "POST",
      body: formData,
      credentials: "include"
    })
      .then((response) => response.text())
      .then((text) => console.log("PHP add_chatentry.php", text))
      .catch((error) => console.log("ERROR: ", error));
  }
  return (
    <div className="App">
      <h2>Chat app</h2>
      <ChatBox chatEntries={chatEntries} />
      <form onSubmit={sendClicked}>
        <input className="chatinput" type="text" name="text" required />
        <input type="submit" value="send" />
      </form>
      <button onClick={onLogout}>Logout</button>
    </div>
  );
}
