import { useState, useEffect } from "react";

import "./Main.css";

import ChatBox from "./ChatBox";

export default function Main() {
  useEffect(() => {
    fetch("http://127.0.0.1:5000/index.php", {credentials: 'same-origin'})
      .then((response) => response.json())
      .then((json) => {
        console.log("PHP", json);
        setChatEntries(json);
      })
      .catch((e) => {
        console.log(e);
      });

    // Check if logged in
    fetch("http://127.0.0.1:5000/login.php", {
      credentials: 'include'
    })
      .then((response) => {
          if (response.status === 200) {
            return response.text()
          } else if (response.status === 401) {
            window.location.href = "/login";
          } else {
            console.log("HTTP ERROR: ", response.status)
          }
      })
      .then((text) => {
        console.log("PHP_LOGIN", text);
      })
      .catch((e) => {
        console.log(e);
      });
  }, []);

  const [chatEntries, setChatEntries] = useState();

  function sendClicked(e) {
    e.preventDefault();
    const text = e.target.elements.text.value;
    console.log(text);

    const formData = new FormData();
    formData.append("user_id", 1);
    formData.append("content", text);

    fetch("http://127.0.0.1:5000/add_chatentry.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((text) => console.log(text))
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
    </div>
  );
}
