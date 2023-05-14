import AuthRepository from "./AuthRepository";
import UserRepository from "./UserRepository";

export default ($axios) => ({
  auth: AuthRepository($axios),
  user: UserRepository($axios),
});
