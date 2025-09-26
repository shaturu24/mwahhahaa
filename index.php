<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>F Word</title>
  <style>
    body {
      font-family: 'Comic Sans MS', cursive, sans-serif;
      background: url('https://i.postimg.cc/MH6Y1F8d/724315f6-17ea-4d6b-b5bc-fd4eee9b244b.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .overlay {
      background: rgba(255, 255, 255, 0.85);
      min-height: 100vh;
      padding: 20px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    h1 {
      text-align: center;
      color: #e91e63;
    }
    .question {
      margin-bottom: 20px;
    }
    .options button {
      display: block;
      width: 100%;
      margin: 6px 0;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      background: #f8bbd0;
      transition: 0.3s;
    }
    .options button:hover {
      background: #f48fb1;
      color: #fff;
    }
    .options button.correct {
      background: #81c784;
      color: white;
    }
    .options button.wrong {
      background: #e57373;
      color: white;
    }
    #result {
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
      font-weight: bold;
    }
    #finalMessage {
      text-align: center;
      font-size: 20px;
      margin-top: 30px;
      display: none;
      color: #6a1b9a;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <div class="container">
      <h1>AKU GANTENG KAN YANK?! COBA TEBAK DULUW</h1>
      <div id="quiz"></div>
      <div id="result"></div>
      <div id="finalMessage">Ciee bener berapa tuh yank mwahahhaa, ayankk sebenarnya aku msih tidak paham apa maksudmu memberikan aku sendiri seminggu, aku mikirnya ayank malah menjauh lama lama entah aku bener atau salah tapi aku gak mawu, iya maaf akhir akhir ini aku terlalu cuek sama ayank karena kerjaan dan lain lain, trus aku masih bilang gak sibuk ke ayank, aku minta maaf yank makanya aku selalu menawarkan telepon malem malem kan? gapapa jadi sleep call buat ayank pun, aku temenin walaupun ayank gak ada suara, aku cuma bebas di waktu malam aja yank jam 4 wib pagi itu dah mulai rame tugasnya, tpi masih okelah yank. Eh malah cerita aneh aku mwahahaha, aku minta maaf lagi sampai detik ini belum bisa bantu menghilangkan rasa trusst issue ayank, aku gak bisa apa apa yank dalam hal ini sebenarnya, yang kupikirn saat ini hanya duid duid dan duid begitu pun game
        dan yap aku kemarin mikir ayank marah marah sama aku smpai ayank nyuruh ngejauhin kamu, itu aku mikir ayank yang ga betah sama aku.. aku sedikit kit heart sih hehe tapi tak apa mwahahaha, seperti kata orang orang lelaki itu tidak bercerita tapi aku tidak begitu maap ayank.., ohya lanjut ke 1 minggu itu, ayank mau cuekin aku 1 minggu gitu? aku tidak paham yank, ohya ayank semoga lekas sembuh yak, aku barusan diajak lari dari kantor buat langsung pulang ke indo, nanti ada saatnya aku ceritain kenapa bisa begini, tetapi aku nolak ajakannya mwahahaha. aku sedikit banyak problem disini tpi tidak mawu cerita akeh akeh.
      </div>
    </div>
  </div>

   <audio id="backsound" src="https://jumpshare.com/s/k7Y9qrHPGV8radjsFArx"></audio>
  <script>
    const quizData = [
      {
        question: "🍔 Makanan favorit aku apa yank?",
        options: ["Mie Ayam", "Ayam", "Ayam Pakai Nasi"],
        answer: 1
      },
      {
        question: "🎶 Genre musik yang paling sering aku dengerin?",
        options: ["Pop", "K-pop", "J-PoP / Anime"],
        answer: 2
      },
      {
        question: "🎥 Film/series kesukaan aku?",
        options: ["Drama Korea", "Marvel", "Anime"],
        answer: 2
      },
      {
        question: "🐶 Hewan kesayangan aku?",
        options: ["Kucing", "Bebek", "Kelinci"],
        answer: 1
      },
      {
        question: "🌙 Aku lebih suka siang atau malam?",
        options: ["Siang", "Malam"],
        answer: 0
      },
      {
        question: "🎮 Game yang paling sering aku mainin?",
        options: ["Honkai: Star Rail", "Genshin Impact", "Uma Musume"],
        answer: 0
      },
      {
        question: "🏖️ Kalau liburan, aku lebih suka ke…",
        options: ["Pantai", "Gunung", "Kota besar", "Kasur"],
        answer: 3
      },
      {
        question: "☕ Minuman favorit aku?",
        options: ["Kopi", "Teh", "Susu"],
        answer: 1
      },
      {
        question: "🎁 Hal kecil yang bikin aku bahagia banget?",
        options: ["Dikasih makanan enak", "Dipeluk tiba-tiba", "Dikasih kata-kata manis"],
        answer: 2
      }
    ];

    const quizContainer = document.getElementById("quiz");
    const resultContainer = document.getElementById("result");
    const finalMessage = document.getElementById("finalMessage");

    let currentQuestion = 0;
    let score = 0;

    function loadQuestion() {
      const q = quizData[currentQuestion];
      quizContainer.innerHTML = `
        <div class="question"><h3>${q.question}</h3></div>
        <div class="options">
          ${q.options.map((opt, i) => 
            `<button onclick="checkAnswer(${i})">${opt}</button>`
          ).join("")}
        </div>
      `;
      resultContainer.innerHTML = "";
    }

    function checkAnswer(selected) {
      const q = quizData[currentQuestion];
      const buttons = document.querySelectorAll(".options button");
      buttons.forEach((btn, i) => {
        if (i === q.answer) {
          btn.classList.add("correct");
        } else if (i === selected) {
          btn.classList.add("wrong");
        }
        btn.disabled = true;
      });

      if (selected === q.answer) {
        score++;
        resultContainer.innerHTML = "✅ Benar Yank!";
      } else {
        resultContainer.innerHTML = "❌ Ih Ayank Parah!";
      }

      setTimeout(() => {
        currentQuestion++;
        if (currentQuestion < quizData.length) {
          loadQuestion();
        } else {
          quizContainer.innerHTML = "";
          resultContainer.innerHTML = `Skor kamu: ${score} / ${quizData.length}`;
          finalMessage.style.display = "block";
        }
      }, 1000);
    }

    loadQuestion();
  </script>
</body>
</html>
