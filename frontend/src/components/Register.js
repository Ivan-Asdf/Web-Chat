export default function Register() {
    function onSubmit(e) {
        e.preventDefault();
        const username = e.target.elements.username.value;
        const password = e.target.elements.password.value;
        const formData = new FormData()
        formData.append("username", username);
        formData.append("password", password);

        fetch("http://127.0.0.1:5000/register.php", {
            method: "POST",
            body: formData
        })
        .then((response) => {
            if (response.status === 200) {
                window.location.href = "/login";
                return response.text();
            } else {
                console.log("register.php HTTP ERROR: ", response.status)
            }
        })
        .then((text) => console.log(text))
        .catch((e) => {
          console.log("register.php ERROR: ", e);
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
    )
}