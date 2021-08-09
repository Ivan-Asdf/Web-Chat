import axios from "axios";

import API_HOST from "../config";
export default function Login() {
  function onSubmit(e) {
    e.preventDefault();
    const username = e.target.elements.username.value;
    const password = e.target.elements.password.value;
    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    axios
      .post(API_HOST + "/login.php", formData)
      .then((response) => {
        localStorage.setItem("jwt", response.data);
        window.location.href = "/";
      })
      .catch((e) => {
        if (e.response) {
          console.log("index.php HTTP ERROR:", e.response.status);
          window.location.href = "/login";
        } else {
          console.log("index.php NETWROK ERROR:", e);
        }
      });
  }

  return (
    <>
      <h2>Login: </h2>
      <form className="Login" onSubmit={onSubmit}>
        <label htmlFor="username">Username: </label>
        <input type="text" name="username" id="username" />
        <br />
        <label htmlFor="password">Password: </label>
        <input type="password" name="password" id="password" />
        <br />
        <input type="submit" />
      </form>
      <a href="/register">Register</a>
    </>
  );
}
