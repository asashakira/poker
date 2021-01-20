#include "texas.h"

using namespace std;

int a[52];

int n_players = 2;

void init() {
  for(int i = 0; i < 52; i++)
    a[i] = i;
}

void shuffle() {
  srand(time(0));
  for(int i = 0; i < 52; i++) {
    int r = i + (rand() % (52 - i));
    swap(a[i], a[r]);
  }
}

void printCard(int card) {
  int suit = card / 13;
  card %= 13;
  switch(card) {
    case 9:
      cout << 'J';
      break;
    case 10:
      cout << 'Q';
      break;
    case 11:
      cout << 'K';
      break;
    case 12:
      cout << 'A';
      break;
    default:
      cout << card + 2;
  }

  switch(suit) {
    case 0:
      cout << " of Diamond";
      break;
    case 1:
      cout << " of Club";
      break;
    case 2:
      cout << " of Heart";
      break;
    case 3:
      cout << " of Ace";
      break;
  }
}

signed main() {
  init();
  shuffle();
  vector<vector<int>> p(n_players);
  queue<int> deck;
  for(int i = 0; i < 52; i++)
    deck.push(a[i]);

  for(int h = 0; h < n_players; h++) {
    for(int i = 0; i < 7; i++) {
      p[h].push_back(deck.front());
      deck.pop();
    }
  }

  vector<int> x {11, 2, 15, 25, 0, 24, 12};
  for(auto xx : x) {
    printCard(xx);
    cout << '\n';
  }
  auto best = bestHand(x);
  for(auto xx : best) {
    printCard(xx);
    cout << '\n';
  }

  return 0;
}

