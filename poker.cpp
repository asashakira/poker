#include "texas.h"

using namespace std;

bool flush(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] /= 13;
  int x = h[0];
  for(int i = 0; i < 5; i++)
    if(h[i] != x)
      return false;
  return true;
}

bool straight(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] %= 13;
  sort(h.begin(), h.end());

  int x = h[0];
  for(int i = 0; i < 5; i++)
    if(h[i] != x++)
      return false;
  return true;
}

bool straightFlush(vector<int> h) {
  if(!flush(h))
    return false;
  if(!straight(h))
    return false;
  return true;
}

bool quads(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] %= 13;
  sort(h.begin(), h.end());

  int x = h[0];
  int count = 0;
  for(int i = 0; i < 5; i++) {
    if(h[i] == x)
      count++;
    else
      x = h[i];
    if(count == 4)
      return true;
  }
  return false;
}

bool trips(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] %= 13;
  sort(h.begin(), h.end());

  int x = h[0];
  int count = 0;
  for(int i = 0; i < 5; i++) {
    if(h[i] == x)
      count++;
    else {
      x = h[i];
      count = 1;
    }
    if(count == 3)
      return true;
  }
  return false;
}

bool twoPair(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] %= 13;
  sort(h.begin(), h.end());

  int x;
  for(int i = 0; i + 1 < 5; i++)
    if(h[i] == h[i + 1]) {
      x = h[i];
      break;
    }
  for(int i = 0; i + 1 < 5; i++) {
    if(h[i] == x) continue;
    if(h[i] == h[i + 1])
      return true;
  }
  return false;
}

bool _pair(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] %= 13;
  sort(h.begin(), h.end());

  for(int i = 0; i + 1 < 5; i++)
    if(h[i] == h[i + 1])
      return true;
  return false;
}

bool fullHouse(vector<int> h) {
  for(int i = 0; i < 5; i++)
    h[i] %= 13;
  sort(h.begin(), h.end());

  int x = h[0];
  int y = h[4];
  int count1 = 0, count2 = 0;
  for(int i = 0; i < 5; i++) {
    if(h[i] == x)
      count1++;
    if(h[i] == y)
      count2++;
  }
  if(count1 > count2)
    swap(count1, count2);

  if(count1 == 2 and count2 == 3)
    return true;
  return false;
}

bool royal(vector<int> h) {
  if(!straightFlush(h))
    return false;
  sort(h.begin(), h.end());
  if(h[0] % 13 != 8)
    return false;
  return true;
}

int yaku(vector<int> h) {
  int rank = 1;
  if(royal(h))
    rank = 10;
  else if(straightFlush(h))
    rank = 9;
  else if(quads(h))
    rank = 8;
  else if(fullHouse(h))
    rank = 7;
  else if(flush(h))
    rank = 6;
  else if(straight(h))
    rank = 5;
  else if(trips(h))
    rank = 4;
  else if(twoPair(h))
    rank = 3;
  else if(_pair(h))
    rank = 2;

  return rank;
}

vector<int> combination;
vector<vector<int>> hand;
int _count = 0;
void comb(int offset, int k, vector<int> h) {
  if(k == 0) {
    for(int i = 0; i < 5; i++)
      hand[_count][i] = combination[i];
    _count++;
    return;
  }
  for(int i = offset; i <= (int)h.size() - k; i++) {
    combination.push_back(h[i]);
    comb(i + 1, k - 1, h);
    combination.pop_back();
  }
}

vector<int> higher(vector<int> a, vector<int> b) {
  // if rank is different
  if(a[5] > b[5])
    return a;
  else if(a[5] < b[5])
    return b;

  // if rank is same
  for(int i = 0; i < 5; i++) {
    a[i] %= 13;
    b[i] %= 13;
  }
  sort(a.begin(), a.end());
  sort(b.begin(), b.end());

  auto ret = a;
  switch(a[5]) {
    case 2:
      {
        int a_pair, b_pair;
        for(int i = 0; i + 1 < 5; i++) {
          if(a[i] == a[i + 1])
            a_pair = a[i];
          if(b[i] == b[i + 1])
            b_pair = b[i];
        }
        if(a_pair < b_pair)
          ret = b;
        if(a_pair == b_pair) {
          vector<int> a_max, b_max;
          for(int i = 0; i < 5; i++) {
            if(a[i] != a_pair)
              a_max.push_back(a[i]);
            if(b[i] != b_pair)
              b_max.push_back(b[i]);
          }
          for(int i = 0; i < 3; i++)
            if(a_max[i] < b_max[i]) {
              ret = b;
              break;
            }
        }
      }
      break;
    case 3:
      {
        int a_pair1, a_pair2, b_pair1, b_pair2;
        for(int i = 0; i + 1 < 5; i++) {
          if(a[i] == a[i + 1])
            a_pair1 = a[i];
          if(b[i] == b[i + 1])
            b_pair1 = b[i];
        }
        for(int i = 0; i + 1 < 5; i++) {
          if(a[i] != a_pair1 and a[i] == a[i + 1])
            a_pair2 = a[i];
          if(b[i] != b_pair1 and b[i] == b[i + 1])
            b_pair2 = b[i];
        }
        // higher pair
        if(a_pair1 < a_pair2) swap(a_pair1, a_pair2);
        if(b_pair1 < b_pair2) swap(b_pair1, b_pair2);
        if(a_pair1 < b_pair1)
          ret = b;
        if(a_pair1 == b_pair1)
          if(a_pair2 < b_pair2)
            ret = b;
        // if both pair equal
        int a_max = 0, b_max = 0;
        for(int i = 0; i < 5; i++) {
          if(a[i] != a_pair1 and a[i] != a_pair2)
            a_max = max(a_max, a[i]);
          if(b[i] != b_pair1 and b[i] != b_pair2)
            b_max = max(b_max, b[i]);
        }
        if(a_max < b_max)
          ret = b;
      }
      break;
    case 4:
      {
        int a_trip, b_trip;
        for(int i = 0; i + 2 < 5; i++) {
          if(a[i] == a[i + 1] and a[i] == a[i + 1])
            a_trip = a[i];
          if(b[i] == b[i + 1] and b[i] == b[i + 1])
            b_trip = b[i];
        }
        if(a_trip < b_trip)
          ret = b;
        if(a_trip == b_trip) {
          vector<int> a_max, b_max;
          for(int i = 0; i < 5; i++) {
            if(a[i] != a_trip)
              a_max.push_back(a[i]);
            if(b[i] != b_trip)
              b_max.push_back(b[i]);
          }
          for(int i = 0; i < 2; i++)
            if(a_max[i] < b_max[i]) {
              ret = b;
              break;
            }
        }
      }
      break;
    case 7:
      {
        int a_trip, b_trip;
        for(int i = 0; i + 2 < 5; i++) {
          if(a[i] == a[i + 1] and a[i] == a[i + 1])
            a_trip = a[i];
          if(b[i] == b[i + 1] and b[i] == b[i + 1])
            b_trip = b[i];
        }
        if(a_trip < b_trip)
          ret = b;
        if(a_trip == b_trip) {
          int a_pair, b_pair;
          for(int i = 0; i + 1 < 5; i++) {
            if(a[i] != a_trip and a[i] == a[i + 1])
              a_pair = a[i];
            if(b[i] != b_trip and b[i] == b[i + 1])
              b_pair = b[i];
          }
          if(a_pair < b_pair)
            ret = b;
        }
      }
      break;
    case 8:
      {
        int a_quad, b_quad;
        for(int i = 0; i + 1 < 5; i++) {
          if(a[i] == a[i + 1])
            a_quad = a[i];
          if(b[i] == b[i + 1])
            b_quad = b[i];
        }
        if(a_quad < b_quad)
          ret = b;
      }
      break;
    default:
      for(int i = 0; i < 5; i++)
        if(a[i] < b[i]) {
          ret = b;
          break;
        }
  }
  return ret;
}

vector<int> bestHand(vector<int> h) {
  combination.resize(0);
  hand.resize(21, vector<int>(5, 0));
  _count = 0;
  comb(0, 5, h);

  int high = 0, high_i = 0;
  for(int i = 0; i < 21; i++) {
    auto rank = yaku(hand[i]);
    if(high < rank) {
      high = rank;
      high_i = i;
    }
  }
  auto best = hand[0];
  switch(high) {
    case 1:
      cout << "high card";
      break;
    case 2:
      cout << "pair";
      break;
    case 3:
      cout << "two pair";
      break;
  }
  cout << '\n';

  for(int i = 0; i < 21; i++)
    if(i == high_i)
      best = hand[i];

  for(auto x : best)
    cout << x << ' ';
  cout << '\n';

  return best;
}
