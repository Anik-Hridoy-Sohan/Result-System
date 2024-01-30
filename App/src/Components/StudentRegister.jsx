import { useContext, useEffect, useState } from "react";
import {
  useGetProgramsWithDepartmentsQuery,
  useGetStagesQuery,
  useSignupMutation,
} from "../Store";
import LoadingContext from "../Context/LoadingContext";
import Toaster from "./Toaster";

const StudentRegister = () => {
  const [signup, result] = useSignupMutation();
  const { data, isSuccess, isError, isLoading } =
    useGetProgramsWithDepartmentsQuery();
  const stage = useGetStagesQuery();
  const [showToast, setShowToast] = useState(false);
  const { setProgress } = useContext(LoadingContext);
  const [toastComponent, setToastComponent] = useState({
    message: "",
    type: "alert alert-info",
  });
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "student",
    address: "",
    mobile: "",
    father_name: "",
    mother_name: "",
    avatar: "",
    doc_file: "",
    nationality: "Bangladeshi",
    dob: "",
    emergency_mobile: "",
    dept_id: "",
    dept: "",
    religion: "",
    // teacher_id: "",
    // staff_id: '',
    student_id: "",
    // previous_id: "",
    program_id: "",
    program: "",
    stage_id: "",
    session: "",
  });
  const handleShowToast = () => {
    setShowToast(true);
    setTimeout(() => setShowToast(false), 3000);
  };

  useEffect(() => {
    if (isLoading || result.isLoading || stage.isLoading) {
      setProgress(30);
    } else {
      setProgress(100);
    }
    if (
      isError ||
      isSuccess ||
      result.isSuccess ||
      result.isError ||
      stage.isSuccess ||
      stage.isError
      // ||
      // stageIsSuccess ||
      // stageIsError
    ) {
      setProgress(100);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [
    isError,
    isLoading,
    isSuccess,
    result.isError,
    result.isLoading,
    result.isSuccess,
    stage.isSuccess,
    stage.isLoading,
    stage.isError,
    // stageIsError,
    // stageIsLoading,
    // stageIsSuccess,
  ]);

  useEffect(() => {
    if (isError) {
      setToastComponent({
        message: "Something went wrong",
        type: "alert alert-error",
      });
    }
    if (isError) {
      handleShowToast();
    }
  }, [data, isError, isSuccess]);

  let renderToast = (
    <Toaster message={toastComponent.message} type={toastComponent.type} />
  );
  let renderDepartmentList = null;
  let renderProgramList = null;
  let renderStageList = null;

  const [deptList, setDeptList] = useState([]);

  useEffect(() => {
    if (isSuccess && data?.data?.length > 0) {
      setDeptList([]);
      data.data.forEach((program) => {
        if (program.departments?.length > 0) {
          if (formData.program_id == program.id || formData.program_id === "") {
            setDeptList((prevDeptList) => [
              ...prevDeptList,
              ...program.departments,
            ]);
            setDeptList((prevDeptList) => {
              const uniqueDepartments = new Set();

              prevDeptList.forEach((dept) => {
                const key = `${dept.id}_${dept.name}_${dept.slug}`;
                uniqueDepartments.add(key);
              });

              deptList.forEach((dept) => {
                const key = `${dept.id}_${dept.name}_${dept.slug}`;
                uniqueDepartments.add(key);
              });

              const uniqueDeptArray = Array.from(uniqueDepartments).map(
                (key) => {
                  const [id, name, slug] = key.split("_");
                  return { id, name, slug };
                }
              );

              return uniqueDeptArray;
            });
          }
        }
      });
    }
  }, [data, formData.program_id, isSuccess]);

  if (Array.isArray(data?.data) && data?.data?.length > 0) {
    renderProgramList = data?.data?.map((program, index) => {
      const render = (
        <option
          key={index}
          value={program.id}
        >{`${program.name}, ${program.slug}`}</option>
      );
      return render;
    });
  }
  if (Array.isArray(deptList) && deptList.length > 0) {
    renderDepartmentList = deptList.map((department, index) => {
      const render = (
        <option
          key={index}
          value={department.id}
        >{`${department.name}, ${department.slug}`}</option>
      );
      return render;
    });
  }

  if (Array.isArray(stage?.data?.data) && stage?.data?.data?.length > 0) {
    renderStageList = stage?.data?.data?.map((stage, index) => {
      const render = (
        <option
          key={index}
          value={stage.id}
        >{`${stage.name}, ${stage.slug}`}</option>
      );
      return render;
    });
  }
  let name_error = null;
  let email_error = null;
  let password_error = null;
  let password_confirmation_error = null;
  // let role_id_error = null;
  let address_error = null;
  let mobile_error = null;
  let father_name_error = null;
  let mother_name_error = null;
  let avatar_error = null;
  let doc_file_error = null;
  let nationality_error = null;
  let dob_error = null;
  let emergency_mobile_error = null;
  let dept_id_error = null;
  let religion_error = null;
  // let teacher_id_error = null;
  // let staff_id_error = null
  let student_id_error = null;
  // let previous_id_error = null;
  let program_id_error = null;
  let stage_id_error = null;
  let session_error = null;

  if (result.status === "rejected") {
    name_error = result?.error?.data?.errors?.name
      ? result?.error?.data?.errors?.name[0]
      : null;
    email_error = result?.error?.data?.errors?.email
      ? result?.error?.data?.errors?.email[0]
      : null;
    password_error = result?.error?.data?.errors?.password
      ? result?.error?.data?.errors?.password[0]
      : null;
    password_confirmation_error = result?.error?.data?.errors
      ?.password_confirmation
      ? result?.error?.data?.errors?.password_confirmation[0]
      : null;
    // role_id_error = result?.error?.data?.errors?.role_id[0];
    address_error = result?.error?.data?.errors?.address
      ? result?.error?.data?.errors?.address[0]
      : null;
    mobile_error = result?.error?.data?.errors?.mobile
      ? result?.error?.data?.errors?.mobile[0]
      : null;
    father_name_error = result?.error?.data?.errors?.father_name
      ? result?.error?.data?.errors?.father_name[0]
      : null;
    mother_name_error = result?.error?.data?.errors?.mother_name
      ? result?.error?.data?.errors?.mother_name[0]
      : null;
    avatar_error = result?.error?.data?.errors?.avatar
      ? result?.error?.data?.errors?.avatar[0]
      : null;
    doc_file_error = result?.error?.data?.errors?.doc_file
      ? result?.error?.data?.errors?.doc_file[0]
      : null;
    nationality_error = result?.error?.data?.errors?.nationality
      ? result?.error?.data?.errors?.nationality[0]
      : null;
    dob_error = result?.error?.data?.errors?.dob
      ? result?.error?.data?.errors?.dob[0]
      : null;
    emergency_mobile_error = result?.error?.data?.errors?.emergency_mobile
      ? result?.error?.data?.errors?.emergency_mobile[0]
      : null;
    dept_id_error = result?.error?.data?.errors?.dept_id
      ? result?.error?.data?.errors?.dept_id[0]
      : null;
    religion_error = result?.error?.data?.errors?.religion
      ? result?.error?.data?.errors?.religion[0]
      : null;
    // teacher_id_error = result?.error?.data?.errors?.teacher_id
    //   ? result?.error?.data?.errors?.teacher_id[0]
    //   : null;
    // staff_id_error = result?.error?.data?.errors?.staff_id ? result?.error?.data?.errors?.staff_id[0] : null;
    student_id_error = result?.error?.data?.errors?.student_id
      ? result?.error?.data?.errors?.student_id[0]
      : null;
    // previous_id_error = result?.error?.data?.errors?.previous_id
    //   ? result?.error?.data?.errors?.previous_id[0]
    //   : null;
    program_id_error = result?.error?.data?.errors?.program_id
      ? result?.error?.data?.errors?.program_id[0]
      : null;
    stage_id_error = result?.error?.data?.errors?.stage_id
      ? result?.error?.data?.errors?.stage_id[0]
      : null;
    session_error = result?.error?.data?.errors?.session
      ? result?.error?.data?.errors?.session[0]
      : null;
  }

  const handleChange = (e) => {
    e.preventDefault();
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };
  const handleSignup = (e) => {
    e.preventDefault();
    signup({ formData });
  };
  return (
    <div className="hero min-h-screen bg-base-200">
      {showToast ? renderToast : null}
      <div className="flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100 px-6 py-5">
        <p className="text-3xl font-semibold text-center">Student Register</p>

        <form className="min-w-max prose">
          <div className="form-control py-1">
            <label className="label label-text">Name</label>
            <input
              name="name"
              type="name"
              placeholder="Name"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.name}
            />
            {name_error ? (
              <p className="text-error justify-end">{name_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">E-mail</label>
            <input
              name="email"
              type="email"
              placeholder="e-mail"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.email}
            />
            {email_error ? (
              <p className="text-error justify-end">{email_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Password</label>
            <input
              name="password"
              type="password"
              placeholder="password"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.password}
            />
            {password_error ? (
              <p className="text-error justify-end">{password_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Confirm Password</label>
            <input
              name="password_confirmation"
              type="password"
              placeholder="confirm password"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.password_confirmation}
            />
            {password_confirmation_error ? (
              <p className="text-error justify-end">
                {password_confirmation_error}
              </p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Program</label>
            <select
              name="program_id"
              className="select select-info w-full max-w-xs"
              onChange={(e) => {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const id = selectedOption.value;
                setFormData({
                  ...formData,
                  program_id: id,
                  program: e.target.value,
                });
              }}
              value={formData.program}
            >
              <option disabled value="" defaultValue>
                Select a Program
              </option>
              {renderProgramList}
            </select>
            {program_id_error ? (
              <p className="text-error justify-end">{program_id_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Department</label>
            <select
              name="dept_id"
              className="select select-info w-full max-w-xs"
              onChange={(e) => {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const id = selectedOption.value;

                setFormData({
                  ...formData,
                  dept_id: id,
                  dept: e.target.value,
                });
              }}
              value={formData.dept}
            >
              <option disabled value="" defaultValue>
                Select a Department
              </option>
              {renderDepartmentList}
            </select>
            {dept_id_error ? (
              <p className="text-error justify-end">{dept_id_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Stages</label>
            <select
              name="stage_id"
              className="select select-info w-full max-w-xs"
              onChange={(e) => {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const id = selectedOption.value;
                setFormData({
                  ...formData,
                  stage_id: id,
                  stage: e.target.value,
                });
              }}
              value={formData.stage}
            >
              <option disabled value="" defaultValue>
                Select a Stage
              </option>
              {renderStageList}
            </select>
            {stage_id_error ? (
              <p className="text-error justify-end">{stage_id_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Student Id</label>
            <input
              name="student_id"
              type="text"
              placeholder="student id"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.student_id}
            />
            {student_id_error ? (
              <p className="text-error justify-end">{student_id_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Session</label>
            <input
              name="session"
              type="string"
              placeholder="session"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.session}
            />
            {session_error ? (
              <p className="text-error justify-end">{session_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Address</label>
            <input
              name="address"
              type="text"
              placeholder="address"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.address}
            />
            {address_error ? (
              <p className="text-error justify-end">{address_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Mobile</label>
            <input
              name="mobile"
              type="text"
              placeholder="mobile"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.mobile}
            />
            {mobile_error ? (
              <p className="text-error justify-end">{mobile_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Father Name</label>
            <input
              name="father_name"
              type="text"
              placeholder="father name"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.father_name}
            />
            {father_name_error ? (
              <p className="text-error justify-end">{father_name_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Mother Name</label>
            <input
              name="mother_name"
              type="text"
              placeholder="mother name"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.mother_name}
            />
            {mother_name_error ? (
              <p className="text-error justify-end">{mother_name_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Picture(Max: 500kb)</label>
            <input
              name="avatar"
              type="file"
              className="file-input file-input-bordered w-full max-w-xs"
              onChange={handleChange}
              required
              value={formData.avatar}
            />
            {avatar_error ? (
              <p className="text-error justify-end">{avatar_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">
              All Document(.zip,.rar,.7z)
            </label>
            <input
              name="doc_file"
              type="file"
              className="file-input file-input-bordered w-full max-w-xs"
              onChange={handleChange}
              required
              value={formData.doc_file}
            />
            {doc_file_error ? (
              <p className="text-error justify-end">{doc_file_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Nationality</label>
            <input
              name="nationality"
              type="text"
              placeholder=""
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.nationality}
            />
            {nationality_error ? (
              <p className="text-error justify-end">{nationality_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Date of Birth</label>
            <input
              name="dob"
              type="date"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.dob}
            />
            {dob_error ? (
              <p className="text-error justify-end">{dob_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Emergency Contact</label>
            <input
              name="emergency_mobile"
              type="text"
              placeholder="mobile"
              className="input input-bordered w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.emergency_mobile}
            />
            {emergency_mobile_error ? (
              <p className="text-error justify-end">{emergency_mobile_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Religion</label>
            <select
              name="religion"
              className="select select-info w-full max-w-xs"
              onChange={(e) => {
                setFormData({ ...formData, religion: e.target.value });
              }}
              value={formData.religion}
            >
              <option disabled value="" defaultValue>
                Select your religion
              </option>
              <option>Buddhism</option>
              <option>Christianity</option>
              <option>Hinduism</option>
              <option>Islam</option>
              <option>Other</option>
            </select>
            {religion_error ? (
              <p className="text-error justify-end">{religion_error}</p>
            ) : null}
          </div>

          <div className="form-control py-1 mt-6">
            <button className="btn btn-outline btn-info" onClick={handleSignup}>
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default StudentRegister;
