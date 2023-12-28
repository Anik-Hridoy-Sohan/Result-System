import Footer from "./Components/Footer";
import Login from "./Components/Login";
import { NavBar } from "./Components/NavBar";
import { Route, Routes, useNavigate } from "react-router-dom";
import Register from "./Components/Register";
import { useGetUserQuery, useInitCsrfQuery, useTestQuery } from "./Store";
import { useEffect, useState } from "react";
import HomePage from "./Components/HomePage";
import UserContext from "./Context/UserContext";
import LoadingContext from "./Context/LoadingContext";
import LoadingBar from "react-top-loading-bar";

const App = () => {
  useTestQuery();
  const navigate = useNavigate();
  useInitCsrfQuery();
  const { data, isSuccess, isLoading } = useGetUserQuery();
  const [progress, setProgress] = useState(0);
  useEffect(() => {
    if (isSuccess) {
      return navigate("/home");
    }
  }, [isSuccess, navigate]);

  useEffect(() => {
    if (isLoading) {
      setProgress(30);
    } else {
      setProgress(100);
    }
  }, [isLoading]);
  return (
    <LoadingContext.Provider value={{ progress, setProgress }}>
      <UserContext.Provider value={{ data, isSuccess }}>
        <header>
          <LoadingBar
            color="#7B66FF"
            progress={progress}
            onLoaderFinished={() => setProgress(0)}
          />
          <NavBar />
        </header>
        <section className="w-5/6 ml-auto mr-auto min-h-screen">
          <Routes>
            <Route path="/" element={<Login />} />
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/home" element={<HomePage />} />
          </Routes>
        </section>
        <Footer />
      </UserContext.Provider>
    </LoadingContext.Provider>
  );
};

export default App;
