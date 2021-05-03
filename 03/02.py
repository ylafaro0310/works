from sklearn import datasets
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.linear_model import Perceptron
import numpy as np
import matplotlib.pyplot as plt

from plot import plot_decision_regions
from logistic import LogisticGD

# Load iris from datasets
iris = datasets.load_iris()
X = iris.data[:,[2,3]]
y = iris.target
#print('Class label:', np.unique(y))

# Split train and test data
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.3, random_state=1, stratify=y
)

# Standard
sc = StandardScaler()
sc.fit(X_train)
X_train_std = sc.transform(X_train)
X_test_std = sc.transform(X_test)

# Fit data by Perceptron
ppn = Perceptron(eta0=0.1, random_state=1)
ppn.fit(X_train_std, y_train)

# Predict
y_pred = ppn.predict(X_test_std)
#print('Misclassified examples: %d' % (y_test != y_pred).sum())

# Plot
X_train_01_subset = X_train_std[(y_train == 0) | (y_train == 1)]
y_train_01_subset = y_train[(y_train == 0) | (y_train == 1)]
lrgd = LogisticGD(eta=0.05, n_iter=1000, random_state=1)
lrgd.fit(X_train_01_subset, y_train_01_subset)
plot_decision_regions(X=X_train_01_subset, y=y_train_01_subset, classifier=lrgd)
plt.xlabel('petal length[standardized]')
plt.ylabel('petal width[standardized]')
plt.tight_layout()
plt.show()