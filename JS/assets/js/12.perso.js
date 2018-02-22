var obj = { first: "John", last: "Doe", name: "Jonathan" };
// Visit non-inherited enumerable keys
Object.keys(obj).forEach(function(key) { //recupere les cles de chaque elements de l'objet
    document.write(key);
});

