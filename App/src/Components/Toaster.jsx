/* eslint-disable react/prop-types */

const Toaster = ({ type, message }) => {
  return (
    <div className="toast">
      <div className={type}>
        <span>{message}</span>
      </div>
    </div>
  );
};

export default Toaster;
