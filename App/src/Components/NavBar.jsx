import { Link } from "react-router-dom";
import ToggleTheme from "./ToggleTheme";
export const NavBar = () => {
  return (
    <div className="navbar bg-base-100">
      <div className="flex-1">
        <a className="btn btn-ghost normal-case text-4xl" href="#">
          Result System
        </a>
      </div>
      <div className="flex-none">
        <ul className="menu menu-horizontal px-1">
          <li>
            <Link to={"/login"} className="link link-primary">
              <p className="text-lg">Login</p>
            </Link>
          </li>
          <li>
            <Link to={"/register"} className="link link-primary">
              <p className="text-lg">Sign Up</p>
            </Link>
          </li>
          <li>
            <ToggleTheme />
          </li>
        </ul>
      </div>
    </div>
  );
};
