let data = { price: 5, qty: 2 }
let internalValue = data.price
Object.defineProperty(data, "price", {
    get(){
        console.log('i was access')
        return internalValue
    },
    set(newval){
        console.log('setter')
    }
})


data.price

data.price = 'cool'