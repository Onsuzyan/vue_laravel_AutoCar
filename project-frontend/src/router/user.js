import User from "../components/user/UserPage";
import Admin from "../components/admin/Admin";
import UserInfo from "../components/admin/UserInfo";

export default [
  {path: '/users', name: 'Admin', component: Admin, meta:{ userAuth:true, roleAdmin:true}},
  {path: '/users/info/:id', name: 'UserInfo', component: UserInfo ,meta:{ userAuth:true }},
  { path: '/user', name: 'User', component: User , meta:{ userAuth:true, roleUser:true} },
]
