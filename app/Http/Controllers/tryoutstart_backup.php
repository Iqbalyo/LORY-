klo ini apa bedanya ya
  $user = Auth::user();

dan ini
 $tryout = Tryout::where('user_id', auth()->id())
        ->whereNull('finished_at')
        ->first();

gimana memahaminy bu guru