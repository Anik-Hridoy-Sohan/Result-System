# Result-System
## Note
Api sanctam csrf token getting method - 
```js
import { useState } from "react";
import "./App.css";
import axios from "./axios";

function App() {
  const [email, setEmail] = useState("anik@anik.com");
  const [password, setPassword] = useState("1234567890");
  const handleLogin = async (e) => {
    e.preventDefault();
    axios.get("/sanctum/csrf-cookie").then(async (response) => {
      // Login...
      if (response.status === 204)
        await axios.post("api/login", {
          email: "anik@anik.com",
          password: "1234567890",
        });
    });
  };
  return (
    <>
      <form onSubmit={handleLogin}>
        <input
          type="email"
          value={email}
          onChange={(e) => {
            setEmail(e.target.value);
          }}
        />
        <input
          type="password"
          value={password}
          onChange={(e) => {
            setPassword(e.target.value);
          }}
        />
        <button type="submit">Submit</button>
      </form>
    </>
  );
}

export default App;
```