<section class="px-6 mb-12">
    <div class="bg-[#1f2d38] rounded-xl shadow-xl overflow-hidden border border-gray-800">
        <table class="w-full text-gray-300">
            <thead>
                <tr class="bg-gradient-to-r from-teal-700 to-teal-500 text-teal-300 uppercase text-sm tracking-wide">
                    <th class="py-4 px-6 text-left">#</th>
                    <th class="py-4 px-6 text-left">Étudiant</th>
                    <th class="py-4 px-6 text-left">Examen</th>
                    <th class="py-4 px-6 text-left">Mention</th>
                    <th class="py-4 px-6 text-left">Décision</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-700 hover:bg-teal-600/20 transition-all duration-300">
                    <td class="py-4 px-6">{{ $resultat->id }}</td>
                    <td class="py-4 px-6 font-medium">{{ $resultat->student->firstname . ' ' . $resultat->student->lastname }}</td>
                    <td class="py-4 px-6">{{ $resultat->exam->title }}</td>
                    <td class="py-4 px-6">{{ $resultat->grade }}</td>
                    <td class="py-4 px-6">
                        @if($resultat->grade >= 10)
                        <span class="inline-block w-[100px] text-center py-2 text-teal-400 bg-teal-500/30 rounded-full shadow-md font-semibold">
                            Validé
                        </span>
                        @else
                        <span class="inline-block w-[100px] text-center py-2 text-red-400 bg-red-500/30 rounded-full shadow-md font-semibold">
                            Invalidé
                        </span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</section>
