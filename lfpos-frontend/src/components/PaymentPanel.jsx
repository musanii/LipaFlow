function PaymentPanel(){

  return(
    <div style={{padding:"20px"}}>

      <h2>Payment</h2>

      <button style={{width:"100%", padding:"15px", marginBottom:"10px"}}>
        Cash
      </button>

      <button style={{width:"100%", padding:"15px", marginBottom:"10px"}}>
        M-Pesa
      </button>

      <button style={{width:"100%", padding:"15px"}}>
        Card
      </button>

    </div>
  )
}

export default PaymentPanel