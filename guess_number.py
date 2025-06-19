import random

random_number = random.randint(1, 10)

user_number = input("Please, input a number between 1 and 10:\n")

number_tries = 3

if user_number != random_number:
    while number_tries > 1:
        number_tries -= 1
        user_number = input(f"Sorry! Try again. You have {number_tries} guesses left:\n")
        
if user_number == random_number:
    print(f"Congratulations! You have guessed the number correctly!")
else:
    print(f"Sorry. You have no guesses left. The random number was {random_number}.")


