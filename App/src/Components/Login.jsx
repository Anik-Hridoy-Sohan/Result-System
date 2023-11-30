import { Link } from "react-router-dom";
import { useState } from "react";
import { useLoginMutation } from "../Store/APIs/UsersAPI";
const Login = () => {
  const [email, setEmail] = useState("anik@anik.com");
  const [password, setPassword] = useState("1234567890");
  const [login, result] = useLoginMutation();

  const handleLogin = async (e) => {
    e.preventDefault();
    login({ email, password });
  };

  return (
    <div className="hero min-h-screen bg-base-200">
      <div className="hero-content flex-col lg:flex-row-reverse">
        <div className="text-center lg:text-left">
          <h1 className="text-5xl font-bold">Login</h1>
          <p className="py-6 font-semibold">Log in to see the result</p>
        </div>
        <div className="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
          <form className="card-body">
            <div className="form-control">
              <label className="label">
                <span className="label-text">email</span>
              </label>
              <input
                type="name"
                placeholder="email"
                className="input input-bordered"
                required
                onChange={(e) => {
                  e.preventDefault();
                  setEmail(e.target.value);
                }}
                value={email}
              />
            </div>
            <div className="form-control">
              <label className="label">
                <span className="label-text">Password</span>
              </label>
              <input
                type="password"
                placeholder="password"
                className="input input-bordered"
                required
                onChange={(e) => {
                  e.preventDefault();
                  setPassword(e.target.value);
                }}
                value={password}
              />
              <label className="label">
                <a href="#" className="label-text-alt link link-hover">
                  Forgot password?
                </a>
              </label>
            </div>
            <div className="flex justify-end">
              {`Don't have account? `}
              <span className="link link-primary mx-2">
                <Link to="/register">Sign Up</Link>
              </span>
            </div>
            <div className="form-control mt-6">
              <button className="btn btn-primary" onClick={handleLogin}>
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
