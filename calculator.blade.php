<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<<style>
body{
  background-color: #446980;

}

.digit-button{
  width: 100px;
  height: 100px;
  border-radius: 30%;

}
.container{
  width: 550px;
  height: 700px;
}
input{
  font-style: bold;
  font-size: 50px;
  background-color: #0c0C0C;
  margin:5px;
  border-radius: 10px;
  color:white;

}

</style>

<body>
<div class="container">
    <div class="row">
            <input type="text" name="output" id="outputTextBox" class="col">
    </div>

    <div class="row">
           <input type="button" value="<--" onclick="backSpace()" class="col" >
           <input type="button" value="C" onclick="clearOutputTextBox()" class="col">
    </div>

    <div class="row">
          <input type="button" value="7" class="digit-button" class="col" >
          <input type="button" value="8" class="digit-button"class="col" >
          <input type="button" value="9" class="digit-button" class="col">
          <input type="button" value="+" id="sumButton" class="col">
    </div>

    <div class="row">
          <input type="button" value="4" class="digit-button" class="col">
          <input type="button" value="5" class="digit-button" class="col">
          <input type="button" value="6" class="digit-button" class="col">
          <input type="button" value="-" id="subButton" class="col">
    </div>

    <div class="row">
          <input type="button" value="1" class="digit-button" class="col">
          <input type="button" value="2" class="digit-button" class="col">
          <input type="button" value="3" class="digit-button" class="col">
          <input type="button" value="*" id="mulButton" class="col">
    </div>

    <div class="row">
          <input type="button" value="0" class="digit-button"class="col">
          <input type="button" value="=" id="equalButton"class="col">
          <input type="button" value="." onclick="addDot()"class="col">
          <input type="button" value="/" id="divButton"class="col">
    </div>
</div>


    <script>

        let lastOutput = 0;
        let lastOperator = '';
        let clearFlag = true;
        let outputTextBox = document.getElementById ('outputTextBox');
        let sumButton = document.getElementById ('sumButton');
        let subButton = document.getElementById ('subButton');
        let equalButton = document.getElementById ('equalButton');

        let operationHistory = [];
        let digits = document.querySelectorAll ('.digit-button');

        updateOutputTextBox ();

        for (let i=0; i<digits.length; i++){
            digits[i].addEventListener ('click', function (){
                let number = digits[i].value;

                addDigit (number);
            });
        }

        equalButton.addEventListener ('click', function (){
            doLogicOperation ('=');
        });

        sumButton.addEventListener ('click', function (){
            doLogicOperation ('+');
        });

        subButton.addEventListener ('click', function (){
            doLogicOperation ('-');
        });

        mulButton.addEventListener ('click', function (){
            doLogicOperation ('*');
        });

        divButton.addEventListener ('click', function (){
            doLogicOperation ('/');
        });

        /**
         * Do Logic operation
         *
         * @param      {string}  operator  The operator
         */
        function doLogicOperation (operator) {
            let outputValue = outputTextBox.value;

            // Push Number to the stack
           // operationHistory.push (outputValue);
            calcOutput(operator);
            // Set clearFlag
            clearFlag = true;

        }

        /**
         * Calc output
         */
        function calcOutput(operator){
            let value = parseFloat (outputTextBox.value);

            if ('-' == lastOperator){
                lastOutput =  lastOutput - value;
            }
            else if ('+' == lastOperator){
                lastOutput = lastOutput + value;
            }
            else if ('*' == lastOperator){
                lastOutput = lastOutput * value;
            }
            else if ('/' == lastOperator){
                division();
            }
            else {
                if (operator == '='){
                    operator = '';
                }

                lastOutput = value;
            }

            //console.log (lastOutput, lastOperator, value, operator);

            lastOperator = operator;

            updateOutputTextBox ();
        }
        function division(){
          //  let value = parseFloat (outputTextBox.value);
            if (value == 0) {
                return;
            }

            lastOutput = lastOutput / value;
        }

        function addDot () {

            let dotIndex = outputTextBox.value.indexOf ('.');

            if (-1 != dotIndex)
            {
                return;
            }

            addDigit ('.');
        }



        /**
         * Update output Textboz
         */
        function updateOutputTextBox () {
            outputTextBox.value = lastOutput;
        }

        /**
         * Clear output textbox
         *
         * @param      {<type>}  argument  The argument
         */
        function clearOutputTextBox (argument) {
            outputTextBox.value = "0";
        }

        /**
         * Add digit to output
         */
        function addDigit (number) {

            if (true == clearFlag){
                outputTextBox.value = number.toString ();
                clearFlag = false;
                    }
            else{
                outputTextBox.value += number.toString ();
               }

        }
        function backSpace() {
            let currentOutput = outputTextBox.value;
            if (clearFlag == true){
                return;
            }
            else{
            currentOutput = currentOutput.substring (0, currentOutput.length - 1);

                if (currentOutput.length == 0){
                currentOutput = "0";
                }
            }
              lastOutput = currentOutput;
            updateOutputTextBox();
        }






    </script>
</body>
</html>

