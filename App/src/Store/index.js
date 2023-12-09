import { configureStore } from "@reduxjs/toolkit";
import { setupListeners } from "@reduxjs/toolkit/dist/query";
import { UsersAPI } from "./APIs/UsersAPI";
import { PostsAPI } from "./APIs/PostsAPI";

export const Store = configureStore({
  reducer: {
    [UsersAPI.reducerPath]: UsersAPI.reducer,
    [PostsAPI.reducerPath]: PostsAPI.reducer,
  },
  middleware: (getDefaultMiddleware) => {
    return getDefaultMiddleware()
      .concat(UsersAPI.middleware)
      .concat(PostsAPI.middleware);
  },
});
setupListeners(Store.dispatch);
export {
  useInitCsrfQuery,
  useGetUserQuery,
  useLoginMutation,
  useSignupMutation,
} from "./APIs/UsersAPI";

export {
  useGetPostsQuery,
  useAddPostMutation,
  useVotePostMutation,
  useAddCommentMutation,
  useGetThePostQuery,
  useGetPendingPostsQuery,
  useDeletePendingPostMutation,
  useApprovePostMutation,
} from "./APIs/PostsAPI";
