import ProductGrid from "../components/ProductGrid";
import Cart from "../components/Cart";
import PaymentPanel from "../components/PaymentPanel";

function POSPage() {
  return (
    <div style={{display:"flex", height:"100vh"}}>

      <div style={{flex:2, borderRight:"1px solid #ccc"}}>
        <ProductGrid/>
      </div>

      <div style={{flex:1}}>
        <Cart/>
        <PaymentPanel/>
      </div>

    </div>
  )
}

export default POSPage