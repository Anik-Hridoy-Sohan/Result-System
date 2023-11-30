import { Link } from "react-router-dom";
import { useState } from "react";
import { useSignupMutation } from "../Store";
const Register = () => {
  const [email, setEmail] = useState("");
  const [name, setName] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [signup, result] = useSignupMutation();
  //   if (result.isError || result.isSuccess) console.log(result);

  return (
    <div className="hero min-h-screen bg-base-200">
      <div className="hero-content flex-col lg:flex-row-reverse">
        <div className="text-center lg:text-left">
          <h1 className="text-5xl font-bold">Register</h1>
          <p className="py-6 font-semibold">Log in to see the result</p>
        </div>
        <div className="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
          <form className="card-body">
            <div className="form-control">
              <label className="label">
                <span className="label-text">Name</span>
              </label>
              <input
                type="name"
                placeholder="name"
                className="input input-bordered"
                required
                onChange={(e) => {
                  e.preventDefault();
                  setName(e.target.value);
                }}
                value={name}
              />
            </div>
            <div className="form-control">
              <label className="label">
                <span className="label-text">E-mail</span>
              </label>
              <input
                type="email"
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
            </div>
            <div className="form-control">
              <label className="label">
                <span className="label-text">Confirm Password</span>
              </label>
              <input
                type="password"
                placeholder="password"
                className="input input-bordered"
                required
                onChange={(e) => {
                  e.preventDefault();
                  setConfirmPassword(e.target.value);
                }}
                value={confirmPassword}
              />
            </div>
            <div className="flex justify-end">
              {`Already have an account?`}
              <span className="link link-primary mx-2">
                <Link to="/login">Log in</Link>
              </span>
            </div>
            <div className="form-control mt-6">
              <button
                className="btn btn-primary"
                onClick={(e) => {
                  e.preventDefault();
                  signup({ name, email, password, confirmPassword });
                }}
              >
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Register;
