export default function Login() {
  function onSubmit(e) {
    e.preventDefault();
    const username = e.target.elements.username.value;
    const password = e.target.elements.password.value;
    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    fetch("http://127.0.0.1:5000/login.php", {
      method: "POST",
      body: formData,
      credentials: "include"
    })
      .then((response) => {
        if (response.status === 200) {
          window.location.href = "/";
        } else {
          console.log("login.php HTTP ERROR: ", response.status);
        }
        return response.text();
      })
      .then((text) => console.log(text))
      .catch((e) => {
        console.log("login.php ERROR: ", e);
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
