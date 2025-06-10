print("Find out if two words are anagrams.")

word_1 = ""

word_2 = ""

word_1 = input("Please introduce your first word: ").lower()

while not word_1.isalpha():
    word_1 = input("You have to introduce a word, without any numbers special characters: ").lower()

word_2 = input("Please introduce your second word: ").lower()

while not word_2.isalpha():
    word_2 = input("You have to introduce a word, without any numbers special characters: ").lower()

list_1 = sorted(word_1)

list_2 = sorted(word_2)

if list_1 == list_2:
    print(True)
else:
    print(False)

