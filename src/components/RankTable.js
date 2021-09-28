
const RankTable = () => {
  const ranks = [
    {
      id: 0,
      text: "ロイヤルストレートスライム",
      bet: 100,
    },
    {
      id: 1,
      text: "ロイヤルストレートフラッシュ",
      bet: 100,
    },
    {
      id: 2,
      text: "ファイブカード",
      bet: 100,
    },
    {
      id: 3,
      text: "ストレートフラッシュ",
      bet: 100,
    },
    {
      id: 4,
      text: "フォーカード",
      bet: 100,
    },
    {
      id: 5,
      text: "フルハウス",
      bet: 100,
    },
    {
      id: 6,
      text: "フラッシュ",
      bet: 100,
    },
    {
      id: 7,
      text: "ストレート",
      bet: 100,
    },
    {
      id: 8,
      text: "スリーカード",
      bet: 100,
    },
    {
      id: 9,
      text: "ツーペア",
      bet: 100,
    },
  ];

  return (
    <div id="rank-table">
      {ranks.map((rank) => (
        <div key={rank.id} className="rank">
          <div className="rank-name">{rank.text}</div>
          <div className="rank-coins">{rank.bet}</div>
        </div>
      ))}
    </div>
  );
}

export default RankTable
