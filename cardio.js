let longestWord = (sen) => {
    let myRegex = /[\w]+/gi;
    let result = sen.match(myRegex);
    let key = 0;
    let longest = 0;
    for (let index = 0; index < result.length; index++) {
        if(result[index].length > longest)  key = index
    }
    return result[key];
} 
console.log(longestWord('hey men, sssssthis')) 


let chunkArray = (array, length) => { 
    let res = []

    // let i = 0
    // while( i < array.length ){
    //     let temp = array.slice(i, (i + length) )
    //     i = i + length
    //     res.push(temp)
    // }
    // return res;

    array.forEach(element => {
        
        const last = res[res.length - 1]
       
        if( !last || last.length === len)
    });

    return res;
}

console.log(chunkArray( ['cool', 'then', 'some', 'asdf', 'sdafa'],  2)) 


 