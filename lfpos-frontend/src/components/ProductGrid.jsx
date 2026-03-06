function ProductGrid(){

  const products = [
    {id:1, name:"Tusker Lager", price:350},
    {id:2, name:"Guinness", price:400},
    {id:3, name:"Mojito", price:650},
    {id:4, name:"Burger", price:800}
  ]

  return (
    <div style={{padding:"20px"}}>
      <h2>Products</h2>

      <div style={{
        display:"grid",
        gridTemplateColumns:"repeat(3,1fr)",
        gap:"10px"
      }}>
        {products.map(product => (
          <button key={product.id} style={{padding:"20px"}}>
            {product.name}
            <br/>
            KES {product.price}
          </button>
        ))}
      </div>

    </div>
  )
}

export default ProductGrid