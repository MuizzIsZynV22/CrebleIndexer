let container = document.getElementById("workspace");
let canvas = document.getElementById("maketable");
let context = canvas.getContext("2d");

var canvasWidth = 860;
var canvasHeight = 700;

context.strokeStyle = "white";
canvas.style.background = "rgba(100, 100, 100, 0.2)";
canvas.width = canvasWidth;
canvas.height = canvasHeight;

// Set the number of rows and columns
var numRows = 5;
var numCols = 7;

var rectWidth = (canvasWidth / numCols) * 0.8;
var rectHeight = (500 / numRows) * 0.6;

// Set the spacing between rectangles
var spacing = 6;

// Calculate the total width and height of the grid
var gridWidth = (rectWidth + spacing) * numCols - spacing;
var gridHeight = (rectHeight + spacing) * numRows - spacing;

// Set the canvas size to fit the grid
canvas.width = gridWidth;
canvas.height = gridHeight;

// Draw the grid of rectangles
for (var row = 0; row < numRows; row++) {
    for (var col = 0; col < numCols; col++) {
        var x = col * (rectWidth + spacing);
        var y = row * (rectHeight + spacing);

        context.strokeStyle = "white";
        context.strokeRect(x, y, rectWidth, rectHeight);
    }
}

var blocks = [];

function createBlock() {
    var wordInput = document.getElementById("wordInput");
    var word = wordInput.value;

    var block = document.createElement("div");
    block.className = "block";
    block.innerHTML = word;

    block.addEventListener("mousedown", startDrag);
    block.addEventListener("mouseup", stopDrag);

    canvas.parentNode.appendChild(block);
    blocks.push(block);
}

function startDrag(event) {
    this.style.zIndex = "1";
    this.style.opacity = "0.5";

    event.dataTransfer.setData("text/plain", event.target.id);
}

function stopDrag(event) {
    this.style.zIndex = "0";
    this.style.opacity = "1";

    var x = event.clientX - canvas.offsetLeft;
    var y = event.clientY - canvas.offsetTop;

    var block = document.getElementById(event.dataTransfer.getData("text/plain"));
    block.style.left = x + "px";
    block.style.top = y + "px";

    block.removeEventListener("mousedown", startDrag);
    block.removeEventListener("mouseup", stopDrag);

    block.addEventListener("mousedown", startDrag);
    block.addEventListener("mouseup", stopDrag);

    block.addEventListener("dragstart", function () {
        return false;
    });

    block.addEventListener("click", function () {
        this.parentNode.removeChild(this);
        blocks.splice(blocks.indexOf(this), 1);
    });

    block.addEventListener("mouseup", function () {
        this.style.border = "2px solid black";
        this.style.backgroundColor = "white";
    });

    block.addEventListener("dragend", function () {
        this.style.border = "2px solid black";
        this.style.backgroundColor = "white";
    });

    block.addEventListener("dragover", function (event) {
        event.preventDefault();
    });

    block.addEventListener("dragenter", function (event) {
        event.preventDefault();
        this.style.border = "2px dashed black";
        this.style.backgroundColor = "lightgray";
    });

    block.addEventListener("dragleave", function () {
        this.style.border = "2px solid black";
        this.style.backgroundColor = "white";
    });

    block.addEventListener("drop", function (event) {
        event.preventDefault();
        this.style.border = "2px solid black";
        this.style.backgroundColor = "lightgreen";
    });

    // Enable dragging for cloned blocks
    block.addEventListener("dragstart", function (event) {
        var clone = this.cloneNode(true);
        clone.id = "clone-" + Date.now();
        clone.style.position = "absolute";
        clone.style.left = this.style.left;
        clone.style.top = this.style.top;

        canvas.parentNode.appendChild(clone);
        blocks.push(clone);

        event.dataTransfer.setData("text/plain", clone.id);
    });
}
