import { useContext, useEffect, useState } from "react";
import LoadingContext from "../Context/LoadingContext";
import Toaster from "./Toaster";
import { useCreateDepartmentMutation, useGetAllUserQuery } from "../Store";
import DynamicSearchBar from "./DynamicSearchBar";

const CreateNewDepartment = () => {
  const { data, isError, isSuccess, isLoading } = useGetAllUserQuery();
  const [createDepartment, result] = useCreateDepartmentMutation();
  const { setProgress } = useContext(LoadingContext);
  const [showToast, setShowToast] = useState(false);
  const [toastComponent, setToastComponent] = useState({
    message: "",
    type: "alert alert-info",
  });

  const [formData, setFormData] = useState({
    name: "",
    slug: "",
    department_code: "",
    chairman_id: "",
    program_id: "",
    semester_number: "",
  });

  const handleShowToast = () => {
    setShowToast(true);
    setTimeout(() => setShowToast(false), 3000);
  };

  useEffect(() => {
    if (result.isLoading || isLoading) {
      setProgress(30);
    } else {
      setProgress(100);
    }
    if (result.isSuccess || result.isError || isSuccess || isError) {
      setProgress(100);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [result.isLoading, result.isSuccess]);

  let name_error = null;
  let slug_error = null;
  let chairman_id_error = null;
  if (result.status === "rejected") {
    name_error = result?.error?.data?.errors?.name
      ? result?.error?.data?.errors?.name[0]
      : null;
    slug_error = result?.error?.data?.errors?.slug
      ? result?.error?.data?.errors?.slug[0]
      : null;
    chairman_id_error = result?.error?.data?.errors?.chairman_id
      ? result?.error?.data?.errors?.chairman_id[0]
      : null;
  }

  useEffect(() => {
    if (result?.error?.data?.message) {
      setToastComponent({
        message: result?.error?.data?.message,
        type: "alert alert-error",
      });
      handleShowToast();
    }
  }, [result?.error?.data?.message]);

  let renderToast = (
    <Toaster message={toastComponent.message} type={toastComponent.type} />
  );

  const searchBarDisplay = (item) => {
    return (
      <>
        <span>
          {item.name}, {item.department}
        </span>
      </>
    );
  };

  const handleChange = (e) => {
    e.preventDefault();
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };
  const handleCreation = (e) => {
    e.preventDefault();
    createDepartment({ formData });
  };
  const onItemSelect = (item) => {
    setFormData({
      ...formData,
      chairman_id: item.id,
    });
  };
  return (
    <div className="hero min-h-screen bg-base-200">
      {showToast ? renderToast : null}
      <div className="flex-shrink-0 shadow-2xl bg-base-100 py-8 px-12 rounded-sm">
        <p className="text-3xl font-semibold text-center">
          Create a new department
        </p>
        <form className="prose">
          <div className="form-control py-1">
            <label className="label label-text">Name</label>
            <input
              name="name"
              type="name"
              placeholder="Name"
              className="input input-bordered input-info w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.name}
            />
            {name_error ? (
              <p className="text-error justify-end">{name_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Short Form</label>
            <input
              name="slug"
              type="name"
              placeholder="Short Form"
              className="input input-bordered input-info w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.slug}
            />
            {slug_error ? (
              <p className="text-error justify-end">{slug_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Short Form</label>
            <input
              name="slug"
              type="name"
              placeholder="Short Form"
              className="input input-bordered input-info w-full max-w-md"
              required
              onChange={handleChange}
              value={formData.slug}
            />
            {slug_error ? (
              <p className="text-error justify-end">{slug_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1">
            <label className="label label-text">Department Chairman</label>
            <DynamicSearchBar
              itemList={data?.data}
              placeholder={"Chairman"}
              onItemSelect={onItemSelect}
              display={searchBarDisplay}
              propertyToFilter={"name"}
            />
            {chairman_id_error ? (
              <p className="text-error justify-end">{chairman_id_error}</p>
            ) : null}
          </div>
          <div className="form-control py-1 mt-6">
            <button className="btn btn-info" onClick={handleCreation}>
              Create
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default CreateNewDepartment;
