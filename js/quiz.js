document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    
    const quizData = {
        'html-intro': [
            {
                question: "What does HTML stand for?",
                options: [
                    "Hyper Text Markup Language", 
                    "High Tech Modern Language", 
                    "Hyper Transfer Markup Language",
                    "Hyperlink and Text Management Language"
                ],
                correctAnswer: 0,
                explanation: "HTML stands for Hyper Text Markup Language, the standard markup language for creating web pages."
            },
            {
                question: "Which HTML tag is used to define an internal style sheet?",
                options: [
                    "<css>", 
                    "<script>", 
                    "<style>", 
                    "<link>"
                ],
                correctAnswer: 2,
                explanation: "The <style> tag is used to define an internal CSS stylesheet within an HTML document."
            },
            {
                question: "Which HTML element is used to specify a footer for a document or section?",
                options: [
                    "<bottom>", 
                    "<section>", 
                    "<footer>", 
                    "<end>"
                ],
                correctAnswer: 2,
                explanation: "The <footer> tag defines a footer for a document or section, typically containing authorship, copyright, or contact information."
            },
            {
                question: "What is the correct HTML element for the largest heading?",
                options: [
                    "<heading>", 
                    "<h6>", 
                    "<head>", 
                    "<h1>"
                ],
                correctAnswer: 3,
                explanation: "<h1> is the largest heading in HTML, with sizes ranging from <h1> (largest) to <h6> (smallest)."
            },
            {
                question: "Which attribute specifies an alternate text for an image?",
                options: [
                    "src", 
                    "alt", 
                    "href", 
                    "title"
                ],
                correctAnswer: 1,
                explanation: "The 'alt' attribute provides alternative text for an image if the image cannot be displayed."
            },
            {
                question: "Which HTML element is used to create a hyperlink?",
                options: [
                    "<link>", 
                    "<a>", 
                    "<href>", 
                    "<hyperlink>"
                ],
                correctAnswer: 1,
                explanation: "The <a> tag is used to create hyperlinks to other web pages, files, locations, or any URL."
            },
            {
                question: "What is the correct HTML for creating a line break?",
                options: [
                    "<break>", 
                    "<lb>", 
                    "<br>", 
                    "<newline>"
                ],
                correctAnswer: 2,
                explanation: "The <br> tag is used to insert a single line break in HTML."
            },
            {
                question: "Which HTML element defines the title of a document?",
                options: [
                    "<meta>", 
                    "<head>", 
                    "<header>", 
                    "<title>"
                ],
                correctAnswer: 3,
                explanation: "The <title> element specifies a title for the HTML page, which is shown in the browser's title bar or page's tab."
            },
            {
                question: "Which HTML attribute is used to define inline styles?",
                options: [
                    "font", 
                    "styles", 
                    "style", 
                    "class"
                ],
                correctAnswer: 2,
                explanation: "The 'style' attribute is used to specify an inline CSS style for a single element."
            },
            {
                question: "What is the correct HTML for inserting an image?",
                options: [
                    "<image src='image.gif'>", 
                    "<img href='image.gif'>", 
                    "<img src='image.gif'>", 
                    "<image href='image.gif'>"
                ],
                correctAnswer: 2,
                explanation: "<img src='image.gif'> is the correct syntax to insert an image in HTML, with 'src' specifying the image source."
            }
        ],
        'css-intro': [
            {
                question: "What does CSS stand for?",
                options: [
                    "Computer Style Sheets", 
                    "Cascading Style Sheets", 
                    "Creative Style System", 
                    "Color and Style Syntax"
                ],
                correctAnswer: 1,
                explanation: "CSS stands for Cascading Style Sheets, used for describing the presentation of a document written in HTML."
            },
            {
                question: "Which CSS property is used to change the text color?",
                options: [
                    "text-color", 
                    "font-color", 
                    "color", 
                    "text-style"
                ],
                correctAnswer: 2,
                explanation: "The 'color' property is used to set the color of text in CSS."
            },
            {
                question: "Which CSS property controls the text size?",
                options: [
                    "font-size", 
                    "text-height", 
                    "font-style", 
                    "text-size"
                ],
                correctAnswer: 0,
                explanation: "The 'font-size' property is used to set the size of the text."
            },
            {
                question: "How do you select an element with id 'demo' in CSS?",
                options: [
                    "*demo", 
                    ".demo", 
                    "#demo", 
                    "demo"
                ],
                correctAnswer: 2,
                explanation: "In CSS, '#demo' is used to select an element with the id 'demo'."
            },
            {
                question: "Which CSS property is used to create a space between elements?",
                options: [
                    "spacing", 
                    "margin", 
                    "padding", 
                    "space"
                ],
                correctAnswer: 1,
                explanation: "The 'margin' property creates space around elements, outside of any defined borders."
            },
            {
                question: "How do you make a list that does not have any bullets?",
                options: [
                    "list-type: none", 
                    "list-style-type: none", 
                    "bulletless: true", 
                    "list: no-bullet"
                ],
                correctAnswer: 1,
                explanation: "list-style-type: none; removes bullets from a list."
            },
            {
                question: "Which CSS property is used to change the background color?",
                options: [
                    "color", 
                    "bgcolor", 
                    "background-color", 
                    "background"
                ],
                correctAnswer: 2,
                explanation: "background-color is used to set the background color of an element."
            },
            {
                question: "How do you select all paragraph elements?",
                options: [
                    "p.all", 
                    "all p", 
                    "p", 
                    "{p}"
                ],
                correctAnswer: 2,
                explanation: "In CSS, 'p' selects all <p> (paragraph) elements."
            },
            {
                question: "Which CSS property is used to create a flexible container?",
                options: [
                    "flex", 
                    "display: flex", 
                    "flexbox", 
                    "container-type: flex"
                ],
                correctAnswer: 1,
                explanation: "display: flex; is used to create a flex container, enabling flexible box layout."
            },
            {
                question: "What does the CSS 'box-sizing: border-box;' do?",
                options: [
                    "Makes the box round", 
                    "Includes padding and border in the element's total width and height", 
                    "Adds a border to the box", 
                    "Increases the box size"
                ],
                correctAnswer: 1,
                explanation: "box-sizing: border-box; ensures that padding and border are included in the element's total width and height."
            }
        ],
        'javascript-basics': [
            {
                question: "What is the correct way to declare a variable in JavaScript?",
                options: [
                    "variable x;", 
                    "var x;", 
                    "x = var;", 
                    "declare x;"
                ],
                correctAnswer: 1,
                explanation: "'var x;' is the traditional way to declare a variable in JavaScript. Modern JavaScript also uses 'let' and 'const'."
            },
            {
                question: "Which operator is used to compare both value and type?",
                options: [
                    "==", 
                    "===", 
                    "=", 
                    "equals"
                ],
                correctAnswer: 1,
                explanation: "=== is the strict equality operator that compares both value and type in JavaScript."
            },
            {
                question: "How do you write a comment in JavaScript?",
                options: [
                    "// This is a comment", 
                    "/* This is a comment */", 
                    "' This is a comment", 
                    "# This is a comment"
                ],
                correctAnswer: 0,
                explanation: "// is used for single-line comments in JavaScript."
            },
            {
                question: "What is the result of 10 + '20' in JavaScript?",
                options: [
                    "30", 
                    "10 20", 
                    "Error", 
                    "1020"
                ],
                correctAnswer: 3,
                explanation: "In JavaScript, when adding a number and a string, type coercion occurs, resulting in string concatenation."
            },
            {
                question: "Which method is used to add an element to the end of an array?",
                options: [
                    "push()", 
                    "append()", 
                    "addToEnd()", 
                    "insert()"
                ],
                correctAnswer: 0,
                explanation: "push() method adds one or more elements to the end of an array."
            },
            {
                question: "How do you create a function in JavaScript?",
                options: [
                    "function = myFunction()", 
                    "function myFunction()", 
                    "create myFunction()", 
                    "def myFunction()"
                ],
                correctAnswer: 1,
                explanation: "function myFunction() {} is the standard way to declare a function in JavaScript."
            },
            {
                question: "What is the correct way to write an if statement?",
                options: [
                    "if x = 5", 
                    "if (x == 5)", 
                    "if x == 5", 
                    "if [x = 5]"
                ],
                correctAnswer: 1,
                explanation: "if (x == 5) {} is the correct syntax for an if statement in JavaScript."
            },
            {
                question: "Which method converts a JSON string to a JavaScript object?",
                options: [
                    "parseJSON()", 
                    "fromJSON()", 
                    "JSON.parse()", 
                    "convertJSON()"
                ],
                correctAnswer: 2,
                explanation: "JSON.parse() method parses a JSON string and converts it to a JavaScript object."
            },
            {
                question: "What does 'NaN' stand for?",
                options: [
                    "Not a Number", 
                    "New and Null", 
                    "Numeric and Numeric", 
                    "No a Notation"
                ],
                correctAnswer: 0,
                explanation: "NaN stands for 'Not a Number' in JavaScript, indicating an invalid number operation."
            },
            {
                question: "How do you declare an arrow function?",
                options: [
                    "function = () => {}", 
                    "() -> {}", 
                    "() => {}", 
                    "def () => {}"
                ],
                correctAnswer: 2,
                explanation: "() => {} is the syntax for an arrow function in JavaScript, introduced in ES6."
            }
        ],
        'web-design-principles': [
            {
                question: "What does responsive web design primarily focus on?",
                options: [
                    "Making websites look beautiful", 
                    "Creating websites that work well on different screen sizes", 
                    "Using the latest design trends", 
                    "Minimizing website code"
                ],
                correctAnswer: 1,
                explanation: "Responsive web design ensures websites adapt and display correctly on various devices and screen sizes."
            },
            {
                question: "What is the primary purpose of a wireframe?",
                options: [
                    "To create a final design", 
                    "To show color schemes", 
                    "To outline the basic structure and layout", 
                    "To test website functionality"
                ],
                correctAnswer: 2,
                explanation: "A wireframe is a basic visual guide that outlines the skeletal framework of a website."
            },
            {
                question: "What is the 'rule of thirds' in web design?",
                options: [
                    "Dividing the page into three equal columns", 
                    "Using three primary colors", 
                    "Dividing the layout into a 3x3 grid for better composition", 
                    "Always using three font types"
                ],
                correctAnswer: 2,
                explanation: "The rule of thirds involves dividing a design into a 3x3 grid to create more balanced and interesting compositions."
            },
            {
                question: "What does UI stand for?",
                options: [
                    "Universal Interface", 
                    "User Interface", 
                    "United Internet", 
                    "Universal Internet"
                ],
                correctAnswer: 1,
                explanation: "UI stands for User Interface, which refers to the space where interactions between humans and machines occur."
            },
            {
                question: "What is the primary goal of UX design?",
                options: [
                    "Making things look pretty", 
                    "Creating user-friendly experiences", 
                    "Using the latest design tools", 
                    "Minimizing website loading time"
                ],
                correctAnswer: 1,
                explanation: "UX (User Experience) design focuses on creating products that provide meaningful and relevant experiences to users."
            }
        ]
    };

    const questionContainer = document.getElementById('question-container');
    const optionsContainer = document.getElementById('options-container');
    const nextBtn = document.getElementById('next-btn');
    const resultSection = document.getElementById('result-section');
    const scoreText = document.getElementById('score-text');
    const certificateBtn = document.getElementById('certificate-btn');
    const tryAgainBtn = document.getElementById('try-again-btn');
    const categoryTitle = document.getElementById('category-title');

    let currentQuestions = quizData[category];
    let currentQuestionIndex = 0;
    let score = 0;

    function loadQuestion() {
        const currentQuestion = currentQuestions[currentQuestionIndex];
        document.getElementById('question-text').textContent = currentQuestion.question;
        
        optionsContainer.innerHTML = '';
        currentQuestion.options.forEach((option, index) => {
            const optionBtn = document.createElement('button');
            optionBtn.textContent = option;
            optionBtn.addEventListener('click', () => checkAnswer(index));
            optionsContainer.appendChild(optionBtn);
        });
    }

    function checkAnswer(selectedIndex) {
        const currentQuestion = currentQuestions[currentQuestionIndex];
        if (selectedIndex === currentQuestion.correctAnswer) {
            score++;
        }
        
        nextBtn.style.display = 'block';
        // Disable option buttons after selection
        Array.from(optionsContainer.children).forEach(btn => {
            btn.disabled = true;
        });
    }

    nextBtn.addEventListener('click', () => {
        currentQuestionIndex++;
        
        if (currentQuestionIndex < currentQuestions.length) {
            loadQuestion();
            nextBtn.style.display = 'none';
        } else {
            endQuiz();
        }
    });

    function endQuiz() {
        questionContainer.style.display = 'none';
        resultSection.style.display = 'block';
        scoreText.textContent = `You scored ${score} out of ${currentQuestions.length}`;
        
        if (score >= 8) {
            certificateBtn.style.display = 'block';
        }else{
            tryAgainBtn.style.display = 'block'
            
        }
        tryAgainBtn.removeEventListener('click', resetQuiz);
        tryAgainBtn.addEventListener('click', resetQuiz);
    }

    function resetQuiz() {
        // Reset quiz state
        score = 0;
        currentQuestionIndex = 0;
        
        // Hide result section
        resultSection.style.display = 'none';
        
        // Hide try again button
        tryAgainBtn.style.display = 'none';
        
        // Show question container
        questionContainer.style.display = 'block';
        
        // Load first question
        loadQuestion();
    }

    certificateBtn.addEventListener('click', () => {
        window.location.href = `certificate.html?category=${category}&score=${score}`;
    });

    // Start the quiz
    categoryTitle.textContent = `${category.replace('-', ' ').toUpperCase()} Quiz`;
    loadQuestion();
});