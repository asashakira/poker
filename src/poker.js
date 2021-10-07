
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

const two = (x) => {
  let a = x.slice();
  for (let i = 0; i < 5; i++)
    a[i] %= 13;
  a.sort();
  let cnt = 0;
  for (let i = 0; i+1 < 5; i++) {
    if (a[i] === a[i+1]) cnt++;
  }
  return cnt === 2;
}

const three = (x) => {
  let a = x.slice();
  for (let i = 0; i < 5; i++)
    a[i] %= 13;
  a.sort();
  for (let i = 0; i+2 < 5; i++) {
    if (a[i] === a[i+1] && a[i] === a[i+2])
      return true;
  }
  return false;
}

const straight = (x) => {
  let a = x.slice();
  for (let i = 0; i < 5; i++)
    a[i] %= 13;
  a.sort();
  let b = a[0];
  for (let i = 0; i < 5; i++) {
    if (a[i] !== b++)
      return false;
  }
  return true;
}

const flush = (x) => {
  let a = x.slice();
  for (let i = 0; i < 5; i++)
    a[i] = Math.floor(a[i]/13);
  for (let i = 0; i < 5; i++) {
    if (a[0] !== a[i])
      return false;
  }
  return true;
}

const fullHouse = (x) => {
  let a = x.slice();
  for (let i = 0; i < 5; i++)
    a[i] %= 13;
  a.sort();
  let b = a[0];
  let c = a[4];
  let cnt1 = 0, cnt2 = 0;
  for (let i = 0; i < 5; i++) {
    if (a[i] === b) cnt1++;
    if (a[i] === c) cnt2++;
  }
  if (cnt1 > cnt2) [cnt1, cnt2] = [cnt2, cnt1];
  return cnt1 === 2 && cnt2 === 3;
}

const four = (x) => {
  let a = x.slice();
  for (let i = 0; i < 5; i++)
    a[i] %= 13;
  a.sort();
  for (let i = 0; i+3 < 5; i++) {
    if (a[i] === a[i+3])
      return true;
  }
  return false;
}

const straightFlush = (x) => {
  let a = x.slice();
  return flush(a) && straight(a);
}

const five = (x) => {
  return false
}

const royal = (x) => {
  let a = x.slice();
  if (!straightFlush(a)) return false;
  return Math.floor(a[0]/13) === 3;
}

const royalSlime = (x) => {
  return false
}

export default handRank
