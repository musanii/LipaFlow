function Cart(){

  const items = []

  return(
    <div style={{padding:"20px", borderBottom:"1px solid #ccc"}}>
      <h2>Cart</h2>

      {items.length === 0 ? (
        <p>No items</p>
      ) : (
        items.map(item => (
          <div key={item.id}>
            {item.name} x {item.qty}
          </div>
        ))
      )}

    </div>
  )
}

export default Cart