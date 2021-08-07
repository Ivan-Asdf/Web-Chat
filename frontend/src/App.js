import { Route, Switch } from "react-router-dom";

import Main from "./components/Main";
import Login from "./components/Login";
import Register from "./components/Register";

export default function App() {
  return (
    <div className="App">
      <Switch>
        <Route path="/login">
          <Login />
        </Route>
        <Route path="/register">
          <Register />
        </Route>
        <Route path="/">
          <Main />
        </Route>
      </Switch>
    </div>
  );
}
