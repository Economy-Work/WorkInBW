from sentence_transformers import SentenceTransformer, util
model = SentenceTransformer('distilbert-base-nli-mean-tokens')

sentences = [
    'the person wear red T-shirt',
    'this person is walking',
    'the boy wear red T-shirt'
    ]
sentence_embeddings = model.encode(sentences)

print(util.pytorch_cos_sim(sentence_embeddings[0], sentence_embeddings[1]))
print(util.pytorch_cos_sim(sentence_embeddings[0], sentence_embeddings[2]))
print(util.pytorch_cos_sim(sentence_embeddings[1], sentence_embeddings[2]))