export default function Register() {
    return (
        <>
        <h2>Register: </h2>
        <form className="Register">
          <label htmlFor="username">Username: </label>
          <input type="text" name="username" id="username" />
          <br />
          <label htmlFor="password">Password: </label>
          <input type="password" name="password" id="password" />
          <br />
          <input type="submit" />
        </form>
      </>
    )
}