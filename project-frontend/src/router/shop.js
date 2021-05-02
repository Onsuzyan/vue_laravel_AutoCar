import Shop from "../components/Shop/Shop";
import GetProduct from "../components/Shop/GetProduct";
import infoProduct from "../components/Shop/InfoProduct";
import EditProduct from "../components/Shop/EditProduct";

export default [
  { path: '/shop', name: 'Shop', component: Shop},
  { path: '/get/product', name: 'GetProduct', component: GetProduct, meta: { userAuth:true ,roleUser:true }},
  { path: '/info/product/:id', name: 'infoProduct', component: infoProduct , meta: { userAuth:false}},
  { path: '/edit/product/:id', name: 'EditProduct', component: EditProduct , meta: { userAuth:true, roleUser:true } },
]
