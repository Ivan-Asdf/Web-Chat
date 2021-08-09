import axios from "axios";

import API_HOST from "../config";

export default function Register() {
  function onSubmit(e) {
    e.preventDefault();
    const username = e.target.elements.username.value;
    const password = e.target.elements.password.value;
    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    axios
      .post(API_HOST + "/register.php", formData)
      .then((response) => {
        window.location.href = "/login";
      })
      .catch((e) => {
        if (e.response) {
          console.log("register.php HTTP ERROR:", e.response.status);
          window.location.href = "/login";
        } else {
          console.log("register.php NETWROK ERROR:", e);
        }
      });
  }
  return (
    <>
      <h2>Register: </h2>
      <form className="Register" onSubmit={onSubmit}>
        <label htmlFor="username">Username: </label>
        <input type="text" name="username" id="username" />
        <br />
        <label htmlFor="password">Password: </label>
        <input type="password" name="password" id="password" />
        <br />
        <input type="submit" />
      </form>
    </>
  );
}
