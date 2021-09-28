
const handRank = (a) => {
  if (royalSlime(a)) return 10;
  if (royal(a)) return 9;
  if (five(a)) return 8;
  if (straightFlush(a)) return 7;
  if (four(a)) return 6;
  if (fullHouse(a)) return 5;
  if (flush(a)) return 4;
  if (straight(a)) return 3;
  if (three(a)) return 2;
  if (two(a)) return 1;
  return 0;
}

const two = (a) => {
  for (let i = 0; i < 5; i++) {
  }
}
const three = (a) => {
}
const straight = (a) => {
}

const flush = (a) => {
  for (let i = 0; i < 5; i++)
    a[i] = Math.floor(a[i]/13);
  for (let i = 0; i < 5; i++) {
    if (a[0] != a[i])
      return false;
  }
  return true;
}

const fullHouse = (a) => {
}
const four = (a) => {
}
const straightFlush = (a) => {
}
const five = (a) => {
  return false
}
const royal = (a) => {
}
const royalSlime = (a) => {
  return false
}
