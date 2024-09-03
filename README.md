## Considering that:
    	{ 1 net ≥ 0
	y = |
    	} 0 net < 0

### Equation to find new weights
	Wᵢⱼ₍ₙ ₊ ₁₎ = Wᵢⱼ₍ₙ₎ + nxᵢ(ydⱼ - yⱼ)

### Weighted average of entries to obtain Net
     ₙ
     Σ = x₁ × w₁
	i=0

### Being x0 = 1 e w0 = -limia

# Perceptron Algorithm in PHP

This repository contains a simple implementation of the Perceptron algorithm in PHP. The Perceptron is a type of artificial neuron used for binary classification tasks. This implementation allows you to train the perceptron on a set of input patterns and weights, and then test the trained model on new data.

## Features

- **Training the Perceptron**: Adjusts weights based on training data using a specified learning rate.
- **Testing the Perceptron**: Tests the trained perceptron on new input patterns to predict the output.
- **Weight Display**: Provides a way to display the final weights after training.

## Prerequisites

- PHP 7.4 or higher

## Usage

### 1. Training the Perceptron

To train the Perceptron, define the training patterns and initial weights, and then invoke the `treinarPerceptro` method.

```php
require_once("Perceptron.php");

$PesosIniciais = [0, 0, 0, 0, 0, 0, 0, 0, 0];

$padroesDeTreinamento = [
    [1,1,1,0,1,0,0,1,0, 1], 
    [1,0,1,1,1,1,1,0,1, 0]
];

$neuronio = new Perceptro(padroes: $padroesDeTreinamento, Pesos: $PesosIniciais);
$neuronio->treinarPerceptro();
$neuronio->exibirPesos();
```

### 2. Testing the Perceptron

After training, you can test the perceptron with new cases.

```php
$casosDeTeste = [
    [1,1,1, 1,1,1, 0,1,0],
    [1,0,0, 1,1,1, 1,0,1],
];

$neuronio->testarPerceptro($casosDeTeste);
```

### 3. Output

The algorithm will output the results of each training cycle and the final weights. During testing, it will also output the predicted results for the test cases.

### Example Output

```
Ciclo: 1
Padrão 1: 1 x (0) + 1 x (0) + 1 x (0) + ... = 0 ==> 1 ? Não

    W0 = 0 + 1 x 1 x (1 - 0) = 1.0
    ...

W(novo) = [ 1.0 0.0 ... ]

TESTANDO O PERCEPTRO TREINADO
Teste 1: 1 x (1.0) + 1 x (0.0) + ... = 1
```

# Perceptron Algorithm in PHP

This repository contains a simple implementation of the Perceptron algorithm in PHP. The Perceptron is a fundamental building block in neural networks, often used for binary classification tasks. This implementation provides functionalities for training a perceptron with a set of patterns and testing it on new data.

## Features

- **Training the Perceptron**: Adjusts weights based on training data using a specified learning rate.
- **Testing the Perceptron**: Tests the trained perceptron on new input patterns to predict the output.
- **Weight Display**: Outputs the final weights after training.
- **Error Handling**: Includes checks to ensure the input data is consistent.

## Prerequisites

- PHP 7.4 or higher

## Usage

### 1. Training the Perceptron

To train the Perceptron, define the training patterns and initial weights, then invoke the `treinarPerceptro` method.

```php
require_once("Perceptron.php");

$PesosIniciais = [0, 0, 0, 0, 0, 0, 0, 0, 0];

$padroesDeTreinamento = [
    [1,1,1,0,1,0,0,1,0, 1], 
    [1,0,1,1,1,1,1,0,1, 0]
];

$neuronio = new Perceptro(padroes: $padroesDeTreinamento, Pesos: $PesosIniciais);
$neuronio->treinarPerceptro();
$neuronio->exibirPesos();
```

### 2. Testing the Perceptron

After training, you can test the perceptron with new cases.

```php
$casosDeTeste = [
    [1,1,1, 1,1,1, 0,1,0],
    [1,0,0, 1,1,1, 1,0,1],
];

$neuronio->testarPerceptro($casosDeTeste);
```

### 3. Output

The algorithm will output the results of each training cycle and the final weights. During testing, it will also output the predicted results for the test cases.

## Functions Explained

### 1. `__construct()`

**Description**: Initializes the Perceptron class with default or provided training patterns, weights, learning rate, and threshold.

**Parameters**:
- `array $padroes`: Training patterns, where each pattern is an array of input values and the expected output (`yd`).
- `array $Pesos`: Initial weights, corresponding to each input.
- `int $taxaDeAprendizagem`: Learning rate, which controls how much the weights are adjusted with each update.
- `int $limiar`: Threshold value used to determine the perceptron’s output (usually 0).

**Example**:
```php
$neuronio = new Perceptro(padroes: $padroesDeTreinamento, Pesos: $PesosIniciais);
```

### 2. `treinarPerceptro()`

**Description**: Trains the perceptron by adjusting the weights until all patterns are correctly classified or a stopping condition is met.

**Parameters**:
- `array $padroes`: Optionally update the training patterns.
- `int $taxaDeAprendizagem`: Optionally update the learning rate.
- `array $Pesos`: Optionally update the initial weights.

**Working**:
- Iteratively goes through each training pattern.
- For each pattern, it calculates the weighted sum (`Σ`).
- Compares the calculated output to the expected output (`yd`).
- If the outputs don’t match, the weights are updated according to the learning rule.
- Continues until the perceptron classifies all patterns correctly.

**Example**:
```php
$neuronio->treinarPerceptro();
```

### 3. `testarPerceptro()`

**Description**: Tests the trained perceptron on new input patterns to see how it performs.

**Parameters**:
- `array $casosDeTeste`: An array of test cases, each containing input values.

**Working**:
- For each test case, the function calculates the weighted sum and determines the perceptron’s output.
- Outputs whether the perceptron activates (1) or not (0) for each test case.

**Example**:
```php
$neuronio->testarPerceptro($casosDeTeste);
```

### 4. `verificacao()`

**Description**: Validates the input data to ensure that the number of weights matches the number of input features and that the training patterns are provided.

**Returns**: 
- `bool`: Returns `true` if the input data is valid, otherwise `false`.

**Working**:
- Checks if weights and training patterns are provided.
- Ensures the number of weights matches the number of inputs in each pattern.

**Example**:
```php
if($neuronio->verificacao()) {
    // Proceed with training or testing
}
```

### 5. `setPadroes()`

**Description**: Sets the training patterns and adjusts them by adding a bias input (`x0 = 1`) to each pattern.

**Parameters**:
- `array $padroes`: The training patterns to be used.

**Example**:
```php
$neuronio->setPadroes($padroesDeTreinamento);
```

### 6. `setPesos()`

**Description**: Sets the initial weights and adds a weight for the bias input (`w0`).

**Parameters**:
- `array $Pesos`: The weights to be used for training.

**Example**:
```php
$neuronio->setPesos($PesosIniciais);
```

### 7. `exibirPesos()`

**Description**: Displays the final weights after the training process is completed.

**Working**:
- Outputs the final weight vector, which represents the trained model.

**Example**:
```php
$neuronio->exibirPesos();
```

## How It Works

1. **Initialization**: The algorithm starts with initial weights and training patterns.
2. **Training Loop**: 
    - For each training cycle, it calculates the weighted sum and updates the weights if the prediction is incorrect.
    - Repeats until all patterns are correctly classified or a predefined condition is met.
3. **Testing**: After training, the perceptron can be tested on new data to evaluate its performance.

## Customization

- **Learning Rate**: The learning rate can be adjusted by passing a new value during initialization.
- **Threshold**: The threshold can be customized in the same way.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

## License

This project is licensed under the MIT License.
