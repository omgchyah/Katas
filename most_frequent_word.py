from collections import Counter
import string

def most_frequent_word():

    filename = input("Please, write name of file adding format (ex: .txt): ")

    with open(filename, 'r', encoding='utf-8') as file:
        text = file.read().lower()

    # Normalize curly apostrophes to straight ones
    text = text.replace("’", "'")

        # Create a punctuation list *excluding* apostrophes
    punctuation_without_apostrophe = string.punctuation.replace("'", "")

    text = text.translate(str.maketrans('', '', punctuation_without_apostrophe))

    word_list = text.split()

    stopwords = ["i", "me", "my", "myself", "we", "our", "ours", "ourselves", "you", "your", "yours", "yourself", "yourselves", "he", "him", "his", "himself", "she", "her", "hers", "herself", "it", "its", "itself", "they", "them", "their", "theirs", "themselves", "what", "which", "who", "whom", "this", "that", "these", "those", "am", "is", "are", "was", "were", "be", "been", "being", "have", "has", "had", "having", "do", "does", "did", "doing", "a", "an", "the", "and", "but", "if", "or", "because", "as", "until", "while", "of", "at", "by", "for", "with", "about", "against", "between", "into", "through", "during", "before", "after", "above", "below", "to", "from", "up", "down", "in", "out", "on", "off", "over", "under", "again", "further", "then", "once", "here", "there", "when", "where", "why", "how", "all", "any", "both", "each", "few", "more", "most", "other", "some", "such", "no", "nor", "not", "only", "own", "same", "so", "than", "too", "very", "s", "t", "can", "will", "just", "don", "should", "now", "it's"]


    for word in word_list:
        if word in stopwords:
            word_list.remove(word)

    c = Counter(word_list)

    if c:
        most_common = c.most_common(1)[0][0]
        print(f"The most frequent word is: {most_common}")
        return most_common
    else:
        print("No valid words found.")
        return None
    pass

if __name__ == "__main__":
    most_frequent_word()


