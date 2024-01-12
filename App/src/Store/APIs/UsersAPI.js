/* eslint-disable no-unused-vars */
import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
const getCookie = (cookieName) => {
  const cookieArray = document.cookie.split(";");

  for (const cookie of cookieArray) {
    let cookieString = cookie;

    while (cookieString.charAt(0) == " ") {
      cookieString = cookieString.substring(1, cookieString.length);
    }
    if (cookieString.indexOf(cookieName + "=") == 0) {
      return cookieString.substring(cookieName.length + 1, cookieString.length);
    }
  }

  return undefined;
};

const UsersAPI = createApi({
  reducerPath: "users",

  baseQuery: fetchBaseQuery({
    baseUrl: `${import.meta.env.VITE_BACKEND_URL}`,
    credentials: "include",
    headers: {
      "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
      "X-Requested-With": "XMLHttpRequest",
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  }),
  endpoints(builder) {
    return {
      initCsrf: builder.query({
        query() {
          return {
            url: "/sanctum/csrf-cookie",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      getUser: builder.query({
        providesTags: (result, error, arg) => {
          const tags = [{ type: "user" }];
          return tags;
        },
        query: () => {
          return {
            url: "/api/user",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      login: builder.mutation({
        query: ({ email, password }) => {
          console.log("login query called");
          return {
            url: "/api/login",
            body: { email, password },
            method: "POST",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
        invalidatesTags: [{ type: "user" }],
      }),
      signup: builder.mutation({
        invalidatesTags: (result, error, arg) => {
          return [{ type: "user" }];
        },
        query: ({ formData }) => {
          return {
            url: "/api/register",
            body: { ...formData },
            method: "POST",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      createProgram: builder.mutation({
        invalidatesTags: (result, error, arg) => {
          return [{ type: "program" }];
        },
        query: ({ formData }) => {
          return {
            url: "/api/create-new-program",
            body: { ...formData },
            method: "POST",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      createDepartment: builder.mutation({
        invalidatesTags: (result, error, arg) => {
          return [{ type: "program" }];
        },
        query: ({ formData }) => {
          return {
            url: "/api/create-new-department",
            body: { ...formData },
            method: "POST",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      getDepartments: builder.query({
        providesTags: (result, error, arg) => {
          const tags = [{ type: "program" }];
          return tags;
        },
        query: () => {
          return {
            url: "/api/get-all-departments",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      getProgramsWithDepartments: builder.query({
        providesTags: (result, error, arg) => {
          const tags = [{ type: "program" }];
          return tags;
        },
        query: () => {
          return {
            url: "/api/get-programs-with-departments",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      getStages: builder.query({
        query: () => {
          return {
            url: "/api/get-all-stages",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
      getAllUser: builder.query({
        query: () => {
          return {
            url: "/api/get-all-users",
            credentials: "include",
            headers: {
              "X-XSRF-TOKEN": decodeURIComponent(getCookie("XSRF-TOKEN")),
              "X-Requested-With": "XMLHttpRequest",
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          };
        },
      }),
    };
  },
});

export const {
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
} = UsersAPI;
export { UsersAPI };
