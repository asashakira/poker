import { useState } from 'react'
import Cards from './Cards'
import Button from './Button'
import handRank from '../poker.js'
import Text from './Text'

const Poker = ({ deck, shuffle, ranks }) => {
  const [judge, setJudge] = useState(false)

  let cards = deck.slice(0, 5);

  const changeCards = () => {
    for (let i = 0; i < 5; i++) {
      if (document.getElementById(`img-${cards[i]}`).checked) {
        cards[i] = deck[i+5];
      }
    }
    setJudge(true);
  }

  const restartPoker = () => {
    shuffle()
    setJudge(false);
  }

  let text = <>掛け金を決め　かえたいカードにチェックを入れ　くばるを押してください．</>
  if (judge) {
    const rank = handRank(cards);
    if (rank === 0) {
      text = <>残念でした！<br/>もういちど　ポーカーを遊びますか？</>;
    } else {
      console.log(ranks[rank].text)
      text = (
        <>
          おめでとうございます！<br/>
          {ranks[rank].text}です！<br/>
          もういちど　ポーカーを遊びますか？
        </>
      );
    }
  }

  return (
    <>
      {judge ? (
        <>
          <Cards cards={cards} />
          <Text text={text} />
          <Button onClick={restartPoker} judge={judge} />
        </>
      ) : (
        <>
          <Cards cards={cards} />
          <Button onClick={changeCards} judge={judge} />
          <Text text={text} />
        </>
      )}
    </>
  )
}

export default Poker
