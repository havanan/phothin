import AuthRepository from "./AuthRepository";
import UserRepository from "./UserRepository";
import AdminRepository from "./AdminRepository";

export default ($axios) => ({
  auth: AuthRepository($axios),
  user: UserRepository($axios),
  admin: AdminRepository($axios),
});
