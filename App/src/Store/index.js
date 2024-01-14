import { configureStore } from "@reduxjs/toolkit";
import { setupListeners } from "@reduxjs/toolkit/dist/query";
import { UsersAPI } from "./APIs/UsersAPI";

export const Store = configureStore({
  reducer: {
    [UsersAPI.reducerPath]: UsersAPI.reducer,
  },
  middleware: (getDefaultMiddleware) => {
    return getDefaultMiddleware().concat(UsersAPI.middleware);
  },
});
setupListeners(Store.dispatch);
export {
  useInitCsrfQuery,
  useGetUserQuery,
  useLoginMutation,
  useSignupMutation,
  useGetDepartmentsQuery,
  useGetAllUserQuery,
  useGetProgramsWithDepartmentsQuery,
  useGetStagesQuery,
  useCreateProgramMutation,
  useCreateDepartmentMutation,
} from "./APIs/UsersAPI";
