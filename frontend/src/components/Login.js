export default function Login() {
    return (
      <>
        <h2>Login: </h2>
        <form className="Login">
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
