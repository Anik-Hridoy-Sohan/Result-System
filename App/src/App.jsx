import Footer from "./Components/Footer";
import Login from "./Components/Login";
import { NavBar } from "./Components/NavBar";
import { Route, Routes } from "react-router-dom";
import Register from "./Components/Register";
import { useGetUserQuery, useInitCsrfQuery } from "./Store";

const App = () => {
  // const { data } = useGetUserQuery();
  // console.log(data);
  const getToken = useInitCsrfQuery();
  const { data, isSuccess, isError } = useGetUserQuery();
  console.log(data);
  return (
    <div>
      <NavBar />
      <section className="w-5/6 ml-auto mr-auto">
        <Routes>
          <Route path="/" element={<Login />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
        </Routes>
      </section>
      <Footer />
    </div>
  );
};

export default App;
