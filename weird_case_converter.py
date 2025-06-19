#Write a function that takes a string and returns the same string with each word converted to "weird case". In weird case, the first letter of each word is uppercase, the second is lowercase, the third is uppercase, and so on.

def to_weird_case(sentence):
    words = sentence.split()
    weird_sentence = ""

    for word in words:
        weird_word = ""
        for i, letter in enumerate(word):
            if i % 2 == 0:
                weird_word += letter.upper()
            else:
                weird_word += letter.lower()
        weird_sentence += weird_word + " "

    return weird_sentence.strip()  # ✅ sangría correcta

# Pedimos input al usuario
user_input = input("Escribe una frase para convertirla: ")
# Mostramos el resultado
print("Tu frase en weird case es:", to_weird_case(user_input))