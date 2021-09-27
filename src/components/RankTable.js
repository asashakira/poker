
const RankTable = () => {
  const rankNames = [
    "ツーペア",
    "スリーカード",
    "ストレート",
    "フラッシュ",
    "フルハウス",
    "フォーカード",
    "ストレートフラッシュ",
    "ファイブカード",
    "ロイヤルストレートフラッシュ",
    "ロイヤルストレートスライム",
  ];

  const table = [];
  for (let i = 9; i >= 0; i--) {
    table.push(
      <div className="rank">
        <div className="rank-name">{rankNames[i]}</div>
        <div className="rank-coins">1000</div>
      </div>
    );
  }
  return (
    <div id="rank-table"> {table} </div>
  );
}

export default RankTable
