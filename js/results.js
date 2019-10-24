function completeRoom() {
    var fs = require("fs");

    fs.readFile("/data/results.json", "utf-8", function (err, data) {
        if (err) throw err

        var arrayofObjects = JSON.parse(data)
        arrayofObjects.users.push({
            name: "Shaun",
            age: 24
        });

        console.log(arrayofObjects)

        fs.writeFile("/data/result.json", JSON.stringify(arrayofObjects), "utf-8", function (err) {
            if (err) throw err
            console.log("Done!")
        });
    });
}

function testNode() {
    var http = require("http");

    //create a server object:
    http.createServer(function (req, res) {
        res.write('Hello World!'); //write a response to the client
        res.end(); //end the response
    }).listen(8080); //the server object listens on port 8080
}