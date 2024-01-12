import { useState } from "react";
import TeacherRegister from "./TeacherRegister";
import StudentRegister from "./StudentRegister";
import StaffRegister from "./StaffRegister";
const Register = () => {
  const [activeTab, setActiveTab] = useState(2); // Set the default active tab

  const handleTabClick = (tabIndex) => {
    setActiveTab(tabIndex);
  };
  return (
    <div>
      <div className="flex justify-center bg-base-100 shadow-3xl">
        <div role="tablist" className="tabs tabs-bordered">
          <a
            role="tab"
            className={`tab ${activeTab === 1 ? "tab-active" : ""}`}
            onClick={() => handleTabClick(1)}
          >
            Teacher
          </a>
          <a
            role="tab"
            className={`tab ${activeTab === 2 ? "tab-active" : ""}`}
            onClick={() => handleTabClick(2)}
          >
            Student
          </a>
          <a
            role="tab"
            className={`tab ${activeTab === 3 ? "tab-active" : ""}`}
            onClick={() => handleTabClick(3)}
          >
            Staff
          </a>
        </div>
      </div>
      {activeTab === 1 && <TeacherRegister />}
      {activeTab === 2 && <StudentRegister />}
      {activeTab === 3 && <StaffRegister />}
    </div>
  );
};

export default Register;
