function consultarAPI(){fetch("https://jsonplaceholder.typicode.com/posts").then(o=>o.json()).then(o=>{const c=o;console.log(c)}).catch(o=>{console.error("Error:",o)})}
//# sourceMappingURL=consultarAPI.js.map
