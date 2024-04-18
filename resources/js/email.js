document.getElementById('name').addEventListener('keyup', (e) => {
    let gmail = String(e.target.value)
        .normalize('NFKD') // split accented characters into their base characters and diacritical marks
        .replace(/[\u0300-\u036f]/g,
        '') // remove all the accents, which happen to be all in the \u03xx UNICODE block.
        .trim() // trim leading or trailing whitespace
        .toLowerCase()
        .replace(/[^a-z0-9-]/g, '-')
        .replace(/-+/g, '')
        .replace(/(^-|-$)/, '')
        +'@gmail.com'
        ;
    
    document.getElementById('email').value = gmail;
    
}); 
