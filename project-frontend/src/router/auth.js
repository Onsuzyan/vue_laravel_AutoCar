import Login from '../components/auth/LogInComponent'
import SignUp from '../components/auth/SignUpComponent'
import Verify from "../components/auth/Verify";

export default [
  { path: '/login', name: 'Login', component: Login , meta: {userAuth:false}},
  { path: '/signup', name: 'SignUp', component: SignUp, meta: {userAuth:false} },
  { path: '/verify/:email/:token', name: 'Verify', component: Verify, meta: {userAuth:false}},
]
